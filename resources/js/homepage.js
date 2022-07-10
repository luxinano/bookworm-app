import React, { Component } from 'react';
import '../css/app.css';
import OnSale from './homepage/onsale';

import Featured from './homepage/featured';

class HomePage extends Component {
    render() {
        return (
            <>
                <OnSale />
                <Featured />
            </>
        );
    }
}

export default HomePage;
