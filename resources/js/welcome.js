import React, {Component} from 'react';
import '../css/app.css';

class Welcome extends Component {
    render() {
        return (
            <main>
                <section className="content">
                    <div className="small-welcome-text">AMA</div>
                    <div className="welcome-text">
                        Welcome to <span>A</span>sset <span>M</span>anagement <span>A</span>pplication
                    </div> 
                </section>
            </main>
        );
    }
}

export default Welcome;