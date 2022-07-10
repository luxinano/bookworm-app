import React, { Component, setState } from 'react';
import '../css/app.css';
import Books from './books';
import { Row, Col, Container, Dropdown, DropdownButton } from 'react-bootstrap';
import Multiselect from 'multiselect-react-dropdown';
import axios from 'axios';
class ShopPage extends Component {
    category = '&category=0';
    author = '&author=0';
    star = '&star=0';
    sort = '&sort=null';
    per_page = '&per_page=20';
    childCallables = null;

    setChildCallables = (callables) => {
        this.childCallables = callables;
    }


    state = {
        categories: [],
        authors: [],
        sort: 'Sort',
        show: 'Show 20',
        fil_category: [0],
        fil_author: []
        
    }

    async componentDidMount() {
        let res = await axios.get(`/api/category`);
        let res2 = await axios.get(`/api/author`);
        this.setState({
            categories: res && res.data ? res.data : [],
            authors: res2 && res2.data ? res2.data : []
        }
        )
    }
    



    render() {
        return (
            <Container>
                <h3>Books</h3> 
                Filtered by 
                <p>{(this.category==='&category=0')
                ? null
                : `Category ${this.state.fil_category}`
                }</p>
                <hr></hr>
                <br></br>

             



                <Container fluid>
                    <Row>
                        <Col md={"2"}>
                            <Row >
                                {/* <Categories /> */}
                                <h5> Category</h5>
                                <Multiselect
                                    placeholder="Categories"
                                    displayValue="category_name"
                                    onKeyPressFn={function noRefCheck() {

                                    }}
                                    onRemove={(a, seleted) => {
                                        this.category = '&category=0';
                                        for (let i = 0; i < a.length; ++i) {
                                            this.category = `${this.category},${a[i].id}`
                                            this.setState({fil_category: a.map(({category_name})=>category_name)});
                                        }
                                        this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        
                                    }}
                                    onSearch={function noRefCheck() { }}
                                    onSelect={(seleted) => {
                                        this.category = '&category=0';
                                        for (let i = 0; i < seleted.length; ++i) {
                                            this.category = `${this.category},${seleted[i].id}`;
                                            this.setState({fil_category: seleted.map(({category_name})=>category_name)});
                                        }
                                        this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        
                                        

                                    }}
                                    options={this.state.categories}
                                    showCheckbox
                                />
                            </Row>
                            <br></br>
                            <Row>
                                <h5> Author</h5>
                                {/* <Authors /> */}
                                <Multiselect
                                    placeholder="Authors"
                                    displayValue="author_name"
                                    onKeyPressFn={function noRefCheck() { }}
                                    onRemove={(seleted) => {
                                        this.author = '&author=0';
                                        for (let i = 0; i < seleted.length; ++i) {
                                            this.author = `${this.author},${seleted[i].id}`
                                        }
                                        this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                    }}
                                    onSearch={function noRefCheck() { }}
                                    onSelect={(seleted) => {
                                        this.author = '&author=0';
                                        for (let i = 0; i < seleted.length; ++i) {
                                            this.author = `${this.author},${seleted[i].id}`
                                        }
                                        this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                    }}
                                    options={this.state.authors}
                                    showCheckbox
                                />
                            </Row>
                            <br></br>
                            <Row>

                                <h5> Rating Review</h5>
                                {/* <RatingReviews /> */}

                                <Multiselect
                                    placeholder="Rating reviews"
                                    displayValue="key"
                                    onSelect={
                                        (seleted) => {
                                            this.star = `&star=${seleted[0].id}`
                                            this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        }
                                    }
                                    options={[
                                        {
                                            id: '0',
                                            key: 'Deselect'
                                        },
                                        {
                                            id: '1',
                                            key: '1 Star'
                                        },
                                        {
                                            id: '2',
                                            key: '2 Star'
                                        },
                                        {
                                            id: '3',
                                            key: '3 Star'
                                        },
                                        {
                                            id: '4',
                                            key: '4 Star'
                                        },
                                        {
                                            id: '5',
                                            key: '5 Star'
                                        },


                                    ]}
                                    singleSelect
                                />
                            </Row>
                        </Col>
                        <Col>
                            <Row>
                                <Col>
                                </Col><Col>
                                    <DropdownButton id="dropdown-basic-button" title={this.state.sort}>
                                        <Dropdown.Item onClick={(e) => {
                                            this.setState({ sort: e.target.textContent });
                                            this.sort = `&sort=sale`
                                            this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        }

                                        }>Sort by on sale</Dropdown.Item>
                                        <Dropdown.Item onClick={(e) => {
                                            this.setState({ sort: e.target.textContent });
                                            this.sort = `&sort=popularity`
                                            this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        }}>Sort by popularity</Dropdown.Item>
                                        <Dropdown.Item onClick={(e) => {
                                            this.setState({ sort: e.target.textContent });
                                            this.sort = `&sort=price_asc`
                                            this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        }

                                        }>Sort by price: low to high</Dropdown.Item>
                                        <Dropdown.Item onClick={(e) => {
                                            this.setState({ sort: e.target.textContent });
                                            this.sort = `&sort=price_desc`;
                                            this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        }

                                        }>Sort by price: high to low</Dropdown.Item>
                                    </DropdownButton>
                                </Col>
                                <Col>
                                    <DropdownButton id="dropdown-basic-button" title={this.state.show} >
                                        <Dropdown.Item onClick={(e) => {
                                            this.setState({ show: e.target.textContent });
                                            this.per_page = `&perpage=5`;
                                            this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        }

                                        }>Show 5</Dropdown.Item>
                                        <Dropdown.Item onClick={(e) => {
                                            this.setState({ show: e.target.textContent });
                                            this.per_page = `&perpage=15`;
                                            this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        }}>Show 15</Dropdown.Item>
                                        <Dropdown.Item onClick={(e) => {
                                            this.setState({ show: e.target.textContent });
                                            this.per_page = `&perpage=20`;
                                            this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        }}>Show 20</Dropdown.Item>
                                        <Dropdown.Item onClick={(e) => {
                                            this.setState({ show: e.target.textContent });
                                            this.per_page = `&perpage=25`;
                                            this.childCallables.doSomething(`${this.category}${this.author}${this.star}${this.sort}${this.per_page}`);
                                        }}>Show 25</Dropdown.Item>
                                    </DropdownButton>
                                </Col></Row>
                            <Books setCallables={this.setChildCallables} />
                        </Col>
                    </Row>



                </Container>

                <div>


                </div>

            </Container>
        );
    }
}

export default ShopPage;
