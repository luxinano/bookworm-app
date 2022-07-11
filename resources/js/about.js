import React, { Component } from 'react'
import { Container, Col, Row } from 'react-bootstrap';
class AboutPage extends Component {
    render() {
        return (
            <Container>

                <h3>About us</h3>
                <hr></hr>
                <div className="about">
                    <h1 style={{textAlign: "center"}}>Welcome to Bookworm</h1>
                    <p>"Bookworm is an independent New York bookstore and language school with locations in
                        Manhattan and Brooklyn. We specialize in travel books and language classes."</p>
                    <Row>
                        <Col>
                            <h4>Our story</h4>
                            <p>The name Bookworm was taken from the original name for New York International Airport,
                                which was renamed JFK in December 1963.
                                Our Manhattan store has just moved to the West Village. Our new location is 170 7th Avenue
                                South, at the corner of Perry Street.
                                From March 2008 through May 2016, the store was located in the Flatiron District.</p>
                        </Col>
                        <Col>
                            <h4>Our vision</h4>
                            <p>One of the last travel bookstores in the country, our Manhattan store carries a range of
                                guidebooks (all 10% off) to suit the needs and tastes of every traveller and budget.
                                We believe that a novel or travelogue can be just as valuable a key to a place as any guidebook,
                                and our well-read, well-travelled staff is happy to make reading recommendations for any
                                traveller, book lover, or gift giver.</p>
                        </Col>
                    </Row>

                </div>

            </Container>
        )
    }
}

export default AboutPage;