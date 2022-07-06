import React, { Component } from 'react';
import Recommemded from './recommended';

import Popular from './popular';
class Featured extends Component {

    render() {
        return (
            <>

            

            <div id="sale" className="row justify-content-md-center ">
            <Recommemded />
            </div>
            <div id="sale" className="row justify-content-md-center ">
            <Popular/>
            </div>
            </>
        );
    }
}
export default Featured;