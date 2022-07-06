import React, { Component} from 'react';
import '../css/app.css';
import axios from 'axios';
import BookCard from './bookcard';
import {Container} from 'react-bootstrap'

class Books extends Component {

  state = {
    listBooks: []
  }

  async componentDidMount() {
    let res = await axios.get(`http://localhost:8000/api/book`);
    this.setState({
      listBooks: res && res.data && res.data.data ? res.data.data : []
    })
  }

  render() {
    let { listBooks } = this.state;
    return (
      <Container>
        <div className="row">
            {listBooks && listBooks.length > 0 &&
              listBooks.map((item, index) => {
                return (
                  <div className="col-md-3" key={index}>
                  <BookCard index={index} 
                  book_price={item.book_price} 
                  final_price={item.final_price} 
                  book_title= {item.book_title} 
                  book_cover={item.book_cover_photo} 
                  author_name= {item.author_name}></BookCard>
                  </div>
                )
              })
            }
        </div>
      </Container>
    );
  }
}

export default Books;