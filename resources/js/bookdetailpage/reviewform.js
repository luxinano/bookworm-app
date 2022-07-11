import React, { Component } from 'react';
import { withFormik, Formik } from 'formik';
import axios from 'axios';


import { Col, Row, Container, Image, Card, ListGroup, Button, ListGroupItem, Form } from 'react-bootstrap'
class ReviewForm extends Component {


    postData(data){
        axios.post('/api/review', 
        data)
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          
        
        }
        )
        window.location.reload();
        

    }

    render() {

        return (
            <Card>

                <Card.Body>
                    <Card.Title>Write a Review</Card.Title>
                    <Formik
                        initialValues={{
                            book_id: this.props.book_id,
                            review_title: "",
                            review_details: "",
                            rating_star: 5,
                        }}
                        onSubmit={(values) => {
                        alert( "Thanks for your review!" );
                        this.postData(values)}}

                    >

                        {({
                            handleSubmit,
                            handleChange,
                            values,
                        }) => (
                            <Form onSubmit={handleSubmit}>

                                <Form.Group className="mb-3">
                                    <Form.Label>Add a title</Form.Label>
                                    <Form.Control type="text"
                                        name="review_title"
                                        onChange={handleChange}
                                        value={values.review_title}
                                    />
                                </Form.Group>

                                <Form.Group className="mb-3">
                                    <Form.Label>Details please! Your review will helps other shoppers.</Form.Label>
                                    <Form.Control as="textarea"
                                        style={{ height: '100px' }}
                                        name="review_details"
                                        onChange={handleChange}
                                        value={values.review_details}
                                    />
                                </Form.Group>

                                <Form.Group className="mb-3">
                                    <Form.Label >Select a rating start</Form.Label>
                                    <Form.Control as="select"
                                        name='rating_star'
                                        value={values.rating_star}
                                        onChange={handleChange}
                                    >
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                    </Form.Control>
                                </Form.Group>

                                <Button variant="primary" type="submit" >
                                    Submit Review
                                </Button>
                            </Form>
                        )}
                    </Formik>

                </Card.Body>
            </Card>
        )
    }
}



export default ReviewForm;