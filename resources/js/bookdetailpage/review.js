import React, { Component, setState } from "react";
import { Container, Card, Nav, Pagination, Dropdown, DropdownButton } from 'react-bootstrap';
import axios from 'axios';

class Review extends Component {
    id = this.props.book_id;
    perpage = 20;
    star = this.props.star;
    sort = 'newtoold';
    state = {
        review: null,
        avg: 0,
        star_count: null,
        sort: 'Sort by date: newest to oldest',
        show: 'Show 20',
    }

    componentDidMount() {
        this.getData(this.id, this.perpage, this.star, 1, this.sort);
    }

    async getData(id, perpage, star, page, sort) {
        let res = await axios.get(`/api/review?id=${id}&perpage=${perpage}&star=${star}&page=${page}&sort=${sort}`);
        let res2 = await axios.get(`/api/review/${id}`);
        let res3 = await axios.get(`/api/review/?id=${id}&avg`);
        this.setState({
            review: res.data,
            star_count: res2.data,
            avg: res3.data
        }
        )
    }
    async getReview(id, perpage, star, page, sort) {
        let res = await axios.get(`/api/review?id=${id}&perpage=${perpage}&star=${star}&page=${page}&sort=${sort}`);
        console.log(`/api/review?id=${id}&perpage=${perpage}&star=${star}`)
        this.setState({
            review: res.data,
        })
    }
    render() {



        let items = [];
        if (this.state.review !== null) {

            let active = this.state.review.current_page;
            //----------------------------
            if (this.state.review.last_page <= 5) {
                //bình thường
                for (let number = 1; number <= this.state.review.last_page; number++) {
                    items.push(
                        <Pagination.Item key={number} active={number === active} activeLabel={''} onClick={(e) => {
                            this.getReview(this.id, this.perpage, this.star, e.target.text, this.sort);
                        }}>
                            {number}
                        </Pagination.Item>,
                    )
                }





            }
            else if (this.state.review.last_page > 5) {
                if (this.state.review.current_page == 1 || this.state.review.current_page == 2) {
                    for (let number = 1; number <= 4; number++) {
                        items.push(
                            <Pagination.Item key={number} active={number === active} activeLabel={''} onClick={(e) => {
                                this.getReview(this.id, this.perpage, this.star, e.target.text, this.sort);
                            }}>
                                {number}
                            </Pagination.Item>,
                        );

                    } items.push(<Pagination.Ellipsis onClick={(e) => {
                        this.getReview(this.id, this.perpage, this.star, this.state.review.current_page + 2, this.sort);
                    }} />);


                } else if (this.state.review.current_page == this.state.review.last_page || this.state.review.current_page == this.state.review.last_page - 1) {
                    items.push(<Pagination.Ellipsis onClick={(e) => {
                        this.getReview(this.id, this.perpage, this.star, this.state.review.current_page - 2, this.sort);
                    }} />);
                    for (let number = this.state.review.last_page - 4; number <= this.state.review.last_page; number++) {
                        items.push(
                            <Pagination.Item key={number} active={number === active} activeLabel={''} onClick={(e) => {
                                this.getReview(this.id, this.perpage, this.star, e.target.text, this.sort);
                            }}>
                                {number}
                            </Pagination.Item>,

                        );
                    }
                }

                else {
                    items.push(<Pagination.Ellipsis onClick={(e) => {
                        this.getReview(this.id, this.perpage, this.star, this.state.review.current_page - 2, this.sort);
                    }} />);
                    for (let number = this.state.review.current_page - 1; number <= this.state.review.current_page + 1; number++) {
                        items.push(
                            <Pagination.Item key={number} active={number === active} activeLabel={''} onClick={(e) => {
                                this.getReview(this.id, this.perpage, this.star, e.target.text, this.sort);
                            }}>
                                {number}
                            </Pagination.Item>,

                        );
                    }
                    items.push(<Pagination.Ellipsis onClick={(e) => {
                        this.getReview(this.id, this.perpage, this.star, this.state.review.current_page + 2, this.sort);
                    }} />);
                }
            }

        }


        const handleClick = (event, key) => {
            this.star = key;
            this.getReview(this.id, this.perpage, this.star, this.state.review.current_page, this.sort);
        };



        return (<>
            <h3>Customer Reviews  </h3> <small> Filtered by () </small>

            <h2>{(this.state.avg !== '') ? this.state.avg.toFixed(2) : 0} Star</h2>

            {(this.state.star_count != null)
                ?
                <Nav>
                    <Nav.Item>
                        <Nav.Link eventKey="disabled" disabled>({this.state.review.total})</Nav.Link></Nav.Item>
                    {this.state.star_count.map((item, key) => (
                        <Nav.Item>
                            <Nav.Link key={key} onClick={(e) => {
                                console.log(e);
                                handleClick(e, item.rating_start)
                            }} >{item.rating_start} star ({item.star_count})</Nav.Link>
                        </Nav.Item>
                    ))}
                </Nav>

                : null
            }

           


            <Nav>
                <Nav.Item>
                {(this.state.review !== null)
                ?
                <>Showing {this.state.review.from} - {this.state.review.to} of {this.state.review.total} reviews</>
                : null
            }</Nav.Item>
            <Nav.Item>
                    <DropdownButton id="dropdown-basic-button" title={this.state.sort}>
                        <Dropdown.Item onClick={(e) => {
                            this.setState({ sort: e.target.textContent });
                            this.sort = `newtoold`
                            this.getReview(this.id, this.perpage, this.star, this.state.review.current_page, this.sort);
                        }

                        }>Sort by date: newest to oldest</Dropdown.Item>
                        <Dropdown.Item onClick={(e) => {
                            this.setState({ sort: e.target.textContent });
                            this.sort = `oldtonew`
                            this.getReview(this.id, this.perpage, this.star, this.state.review.current_page, this.sort);
                        }}>Sort by date: oldest to newest</Dropdown.Item>

                    </DropdownButton>
                </Nav.Item>
                <Nav.Item>
                    <DropdownButton id="dropdown-basic-button" title={this.state.show} >
                        <Dropdown.Item onClick={(e) => {
                            this.setState({ show: e.target.textContent });
                            this.perpage = 5;
                            this.getReview(this.id, this.perpage, this.star, this.state.review.current_page, this.sort);
                        }

                        }>Show 5</Dropdown.Item>
                        <Dropdown.Item onClick={(e) => {
                            this.setState({ show: e.target.textContent });
                            this.perpage = 10;
                            this.getReview(this.id, this.perpage, this.star, this.state.review.current_page, this.sort);
                        }}>Show 15</Dropdown.Item>
                        <Dropdown.Item onClick={(e) => {
                            this.setState({ show: e.target.textContent });
                            this.perpage = 20;
                            this.getReview(this.id, this.perpage, this.star, this.state.review.current_page, this.sort);
                        }}>Show 20</Dropdown.Item>
                        <Dropdown.Item onClick={(e) => {
                            this.setState({ show: e.target.textContent });
                            this.perpage = 25;
                            this.getReview(this.id, this.perpage, this.star, this.state.review.current_page, this.sort);
                        }}>Show 25</Dropdown.Item>
                    </DropdownButton>
                </Nav.Item>
            </Nav>
            {
                (this.state.review != null && this.state.review.data.length != 0)
                    ? <> {this.state.review.data.map((item, idx) => (
                        <div key={idx} class="my-2">
                            <Card>
                                <Card.Body>
                                    <Card.Text>
                                        <h5 class="d-inline">{item.review_title} </h5><small class="d-inline">| {item.rating_start} stars</small>
                                        <p>{item.review_details}</p>
                                        <p>{item.review_date} </p>
                                    </Card.Text>
                                </Card.Body>
                            </Card>
                        </div>

                    ))}

                        <Pagination>
                            <Pagination.First onClick={() => {

                                this.getReview(this.id, this.perpage, this.star, 1, this.sort);;
                            }} />
                            <Pagination.Prev onClick={() => {

                                this.getReview(this.state.api, this.perpage, this.star, (this.state.review.current_page - 1) == 0 ? 1 : (this.state.review.current_page - 1), this.sort);
                            }} />
                            {items}
                            <Pagination.Next onClick={() => {
                                this.getReview(this.id, this.perpage, this.star, this.state.review.current_page == this.state.review.last_page ? this.state.review.current_page : (this.state.review.current_page + 1), this.sort);
                            }} />
                            <Pagination.Last onClick={() => {

                                this.getReview(this.id, this.perpage, this.star, this.state.review.last_page, this.sort);
                            }} />
                        </Pagination>

                    </>
                    : <p> No review </p>
            }

        </>);
    }
}



export default Review;