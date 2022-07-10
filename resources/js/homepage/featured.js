import React, { Component } from 'react';
import Recommemded from './recommended';
import { Tab, Nav } from 'react-bootstrap'

import Popular from './popular';
class Featured extends Component {



    render() {



        return (


            <div id="featured" className="row justify-content-md-center ">

                <h4 className="text-center">Featured Books</h4>

                <Tab.Container defaultActiveKey="first">

                    <Nav variant="tabs" className="justify-content-md-center ">
                        <Nav.Item >
                            <Nav.Link eventKey="first">Recommemded</Nav.Link>
                        </Nav.Item>
                        <Nav.Item >
                            <Nav.Link eventKey="second">Popular</Nav.Link>
                        </Nav.Item>
                    </Nav>
                    <div className="featured-container  " >
                        <Tab.Content >
                            <Tab.Pane eventKey="first">
                                <Recommemded />
                            </Tab.Pane>
                            <Tab.Pane eventKey="second">
                                <Popular />
                            </Tab.Pane>
                        </Tab.Content>
                    </div>
                </Tab.Container>

            </div>

        );
    }
}
export default Featured;