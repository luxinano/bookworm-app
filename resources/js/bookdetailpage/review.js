import React, { Component } from "react";
import { Container} from 'react-bootstrap';

import { useParams } from 'react-router-dom';

// componentDidMount() {
// }

function withParams(Component) {
    return props => <Component {...props} params={useParams()} />;
}


class Review extends Component {
    render() {
        return(<>
        <h3>Customer Reviews</h3><small>Filtered by 5 star</small>
            <h2>{this.props.avg_star}</h2>
            <small>
            <p>{this.props.total}</p>


            </small>

        </>);
    }
}



export default Review;