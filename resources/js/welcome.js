import React, {Component} from 'react';
import '../css/app.css';

class Welcome extends Component {
    render() {
        return (
            <main>
                <section className="content">
                    <div className="small-welcome-text">AMA</div>
                    <div className="welcome-text">
                        Welcome to <span>B</span>ook <span>W</span>orm
                    </div>
                </section>
            </main>
        );
    }
}

export default Welcome;
