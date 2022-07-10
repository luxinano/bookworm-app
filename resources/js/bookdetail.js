import React, { Component, setState } from 'react';
import '../css/app.css';
import { useParams } from 'react-router-dom';
import axios from 'axios';
import { IMAGES } from './image.js'
import InputNumber from './bookdetailpage/inputnumber';
import { Col, Row, Container, Image, Card, ListGroup, Button, ListGroupItem } from 'react-bootstrap'

function withParams(Component) {
    return props => <Component {...props} params={useParams()} />;
}


class BookDetail extends Component {


    state = {
        book: null,
    }

    componentDidMount() {
        let { id } = this.props.params;
        this.getData(id);
    }


    async getData(id) {
        let res = await axios.get(`/api/book/${id}`);
        this.setState({
            book: res.data[0]
        }

        )
    }

    render() {
        return (
            <>
                {(this.state.book != null) ?
                    <>
                        <h3>{this.state.book.category_name}</h3>
                        <hr></hr>
                        <Container fluit>
                            
                                <Row>
                                
                                    <Col>
                                        <Card>
                                            <Row>
                                                <Col>
                                                <Row>
                                                    <Image  src={IMAGES[this.state.book.book_cover_photo]} className="md-2"></Image>
                                                    </Row>
                                                    <Row>
                                                    <small className="m-2">By (author) <b>{this.state.book.author_name}</b></small>
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

                                    <Col md={3}>

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
                            
                        </Container>
                    </>
                    : null

                }
            </>)
    }
}

export default withParams(BookDetail);