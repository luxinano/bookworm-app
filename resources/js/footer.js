import React, { Component } from 'react';
import '../css/app.css';
import bookworm_icon from '../assets/bookworm_icon.svg';
import {  Container} from 'react-bootstrap';

class Footer extends Component {
    render() {
        return (
            <div id="footer">
                <Container fluid bg="light" expand="lg">
                        <img
                            src={bookworm_icon}
                            height="64"
                            className="d-inline-block align-top"
                            alt="Bookworm logo"></img>
                <div  className="d-inline-block align-top ms-5" >
                <p>Address</p>
                Phone
                </div>
                </Container>
                </div>
            );
    }
}

export default Footer;
