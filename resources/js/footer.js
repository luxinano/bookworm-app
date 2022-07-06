import React, { Component } from 'react';
import '../css/app.css';
import bookworm_icon from '../assets/bookworm_icon.svg';
import {  Container} from 'react-bootstrap';

class Footer extends Component {
    render() {
        return (
            
                <Container fluid bg="light" expand="lg">
                        <img
                            src={bookworm_icon}
                            height="64"
                            className="d-inline-block align-top"
                            alt="Bookworm logo"></img>
                Address
                Phone
                </Container>
            );
    }
}

export default Footer;
