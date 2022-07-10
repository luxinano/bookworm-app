import React, { Component } from 'react';
import axios from 'axios';
import { Container } from 'react-bootstrap';
import BookCard from '../bookcard';
class Popular extends Component {

    state = {
        popularBooks: []

    }

    async componentDidMount() {
        let res = await axios.get(`http://localhost:8000/api/book?popular`);
        this.setState({
            popularBooks: res && res.data ? res.data : []
        })
    }


    render() {
        let { popularBooks } = this.state;
        return (
            <Container className="row">
                {popularBooks && popularBooks.length > 0 &&
                    popularBooks.map((item, index) => {
                        return (

                            <div className="col-md-3" key={index}>
                                <BookCard index={index}
                                final_price={item.final_price}
                                    book_price={item.book_price}
                                    book_title={item.book_title}
                                    book_cover={item.book_cover_photo}
                                    author_name={item.author_name}>
                                </BookCard>
                            </div>
                        )
                    })
                }
                </Container>
          
        );
    }
}
export default Popular;
