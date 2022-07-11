import React, { Component, setState } from 'react';
import '../css/app.css';
import { useParams } from 'react-router-dom';
import axios from 'axios';
import { IMAGES } from './image.js'
import InputNumber from './bookdetailpage/inputnumber';
import { Col, Row, Container, Image, Card, ListGroup, Button, ListGroupItem, Form } from 'react-bootstrap'
import Review from './bookdetailpage/review';
import ReviewForm from './bookdetailpage/reviewform';
import { withFormik } from 'formik';
function withParams(Component) {
    return props => <Component {...props} params={useParams()} />;
}


class BookDetail extends Component {


    state = {
        book: null,
        star: 0,
    }

    componentDidMount() {
        let { id } = this.props.params;
        this.getData(id);
    }


    async getData(id) {
        let res = await axios.get(`/api/book/${id}`);

        this.setState({
            book: res.data[0],

        }

        )
    }

    render() {





        return (
            <Container>
                {(this.state.book != null) ?
                    <>
                        <h3>{this.state.book.category_name}</h3>
                        <hr></hr>
                        <Container>

                            <Row>

                                <Col>
                                    <Card>
                                        <Row>
                                            <Col>
                                                <Row>
                                                    <Image src={IMAGES[this.state.book.book_cover_photo]} className="md-2"></Image>
                                                </Row>
                                                <Row>
                                                    <small className="m-3">By (author) <b>{this.state.book.author_name}</b></small>
                                                </Row>
                                            </Col>
                                            <Col>
                                                <Container>

                                                    <h3>{this.state.book.book_title}</h3>
                                                    <p>{this.state.book.book_summary}</p>
                                                </Container>
                                            </Col>

                                            <br></br>
                                        </Row>
                                    </Card>
                                </Col>

                                <Col md={4}>

                                    <ListGroup >
                                        <ListGroupItem>
                                            {(this.state.book.final_price != this.state.book.book_price)
                                                ? <>
                                                    <small><del>${this.state.book.book_price}</del></small>
                                                    <b> ${this.state.book.final_price}</b>
                                                </>
                                                : <> ${this.state.book.book_price}</>}
                                        </ListGroupItem>
                                        <ListGroupItem>
                                            <Container>
                                                <InputNumber></InputNumber>
                                                <Button>Add to card</Button>
                                            </Container>
                                        </ListGroupItem>

                                    </ListGroup>

                                </Col>
                            </Row>
                            <br></br>
                            <Row>
                                <Col>
                                    <Card>
                                        <Card.Body>
                                            <Review book_id={this.state.book.id} star={this.state.star}></Review>
                                            <Row>
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
                                                        : null
                                                }
                                            </Row>
                                        </Card.Body>
                                    </Card>
                                </Col>
                                <Col md={4}>


                                    <ReviewForm book_id={this.state.book.id} />



                                </Col>
                            </Row>
                        </Container>
                    </>
                    : null

                }
            </Container>)
    }
}





export default withParams(BookDetail);