import React, { Component  } from 'react';
import '../css/app.css';
import { Card, ListGroup, ListGroupItem } from 'react-bootstrap';
import { IMAGES } from './image.js'
class BookCard extends Component {
    render() {
      return ( 
        <Card   className="book-card shadow-sm">
          <Card.Img variant="top" src={IMAGES[this.props.book_cover]} className="book-cover"/>
          <Card.Body>
            <Card.Title>{this.props.book_title}</Card.Title>
            <Card.Text variant="bottom">
                  {this.props.author_name}
                </Card.Text>
          </Card.Body>
            <ListGroup className="list-group-flush">
              <ListGroupItem>

                ${this.props.book_price}
              
                <b>{this.props.final_price}</b>
              
              </ListGroupItem>
            </ListGroup>
        </Card>
      )
    }
  }

  export default BookCard;