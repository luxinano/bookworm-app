import React, { Component } from 'react';
import axios from 'axios';
import { Container } from 'react-bootstrap';
import BookCard from '../bookcard';
class Recommemded extends Component {


    state = {
        recommendedBooks: []

    }

    async componentDidMount() {
        let res = await axios.get(`/api/book?recommended`);
        this.setState({
            recommendedBooks: res && res.data ? res.data : []
        })
    }


    render() {
        let { recommendedBooks } = this.state;
        return (
            <Container className="row" >
                {recommendedBooks && recommendedBooks.length > 0 &&
                    recommendedBooks.map((item, index) => {
                        return (

                            <div className="col-md-3" key={index}>
                                <BookCard index={index}
                                    book_price={item.book_price}
                                    final_price={item.final_price}
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
export default Recommemded;