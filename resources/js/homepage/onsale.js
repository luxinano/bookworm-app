import React, { Component } from 'react';
import Slider from "react-slick";
import axios from 'axios';
import BookCard from '../bookcard';
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import { Button, Container } from 'react-bootstrap';
class OnSale extends Component {

    state = {
        saleBooks: []

    }

    async componentDidMount() {
        let res = await axios.get(`http://localhost:8000/api/book?sale`);
        this.setState({
            saleBooks: res && res.data ? res.data : []
        })
    }




    render() {

        const settings = {
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 4,
            slidesToScroll: 3,
            arrows: true
        };

        let { saleBooks } = this.state;
        return (
            <div id="sale" className="row justify-content-md-center ">
                <h4 className="col-md-11 ">On Sale</h4>
                <Button href="#/books " className="col-md-1 view-all-button" variant="danger">View All</Button>
                <div className="sale-container">
                    <Container >
                        <Slider {...settings} >
                            {saleBooks && saleBooks.length > 0 &&
                                saleBooks.map((item, index) => {
                                    return (
                                        <div key={index}>
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

                        </Slider>
                    </Container>
                </div>
            </div>
        )
    }
}

export default OnSale;