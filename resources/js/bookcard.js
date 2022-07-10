import React, { Component  } from 'react';
import '../css/app.css';
import { Card, ListGroup, ListGroupItem, Button } from 'react-bootstrap';
import { IMAGES } from './image.js'
class BookCard extends Component {
    render() {
      let price;
      if (this.props.final_price !=  this.props.book_price) {
        price = <>
                <del>${this.props.book_price}</del>
                <b> ${this.props.final_price}</b>
                </>;
      } else {
        price =<> ${this.props.book_price}</>;
      }

      return ( 
        <Card   className="book-card shadow-sm">
        <Button href={`#/book/${this.props.id}`}>
          <Card.Img variant="top" src={IMAGES[this.props.book_cover]} className="book-cover"/>
          </Button>
          <Card.Body>
            <Card.Title><h6>{this.props.book_title}</h6></Card.Title>
            <Card.Text variant="bottom">
            <small>
                  {this.props.author_name}</small>
                </Card.Text>
          </Card.Body>
            <ListGroup className="list-group-flush " >
              <ListGroupItem id="price">

               {price}
              
              </ListGroupItem>
            </ListGroup>
        </Card>
      )
    }
  }

  export default BookCard;