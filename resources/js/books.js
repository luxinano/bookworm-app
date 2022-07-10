import React, { Component, useEffect, setState } from 'react';
import '../css/app.css';
import axios from 'axios';
import BookCard from './bookcard';
import { Container, Pagination } from 'react-bootstrap'

class Books extends Component {



  state = {
    api: '/api/book?null',
    page: 1,
    list_books: null,
  }

  componentDidMount() {
    this.getBooksData();

    this.props.setCallables({
      doSomething: this.doSomething
    });
  }

  doSomething = (api) => {


    this.getBooksData(this.state.api + api, this.state.page);
    this.setState({
      api: '/api/book?null' + api,
    })
  }

  async getBooksData(api = this.state.api, page = this.state.page) {
    let url = api + '&page=' + page;
    let res = await axios.get(url);

    this.setState({
      list_books: res.data
    }
    )
  }





  render() {
    let items = [];
    if (this.state.list_books !== null) {

      let active = this.state.list_books.current_page;
      //----------------------------
      if (this.state.list_books.last_page <= 5) {
        //bình thường
        for (let number = 1; number <= this.state.list_books.last_page; number++) {
          items.push(
            <Pagination.Item key={number} active={number === active} activeLabel={''} onClick={(e) => {

              this.getBooksData(this.state.api, e.target.text);
            }}>
              {number}
            </Pagination.Item>,
          )
        }





      }
      else if (this.state.list_books.last_page > 5) {
        if (this.state.list_books.current_page == 1 || this.state.list_books.current_page == 2) {
          for (let number = 1; number <= 4; number++) {
            items.push(
              <Pagination.Item key={number} active={number === active} activeLabel={''} onClick={(e) => {
                this.getBooksData(this.state.api, e.target.text);
              }}>
                {number}
              </Pagination.Item>,
            );

          } items.push(<Pagination.Ellipsis onClick={(e) => {
            this.getBooksData(this.state.api, this.state.list_books.current_page+2);
          }} />);


        } else if (this.state.list_books.current_page == this.state.list_books.last_page || this.state.list_books.current_page == this.state.list_books.last_page - 1) {
          items.push(<Pagination.Ellipsis onClick={(e) => {
            this.getBooksData(this.state.api, this.state.list_books.current_page-2);
          }}/>);
          for (let number = this.state.list_books.last_page - 4; number <= this.state.list_books.last_page; number++) {
            items.push(
              <Pagination.Item key={number} active={number === active} activeLabel={''} onClick={(e) => {
                this.getBooksData(this.state.api, e.target.text);
              }}>
                {number}
              </Pagination.Item>,

            );
          }
        }

        else {
          items.push(<Pagination.Ellipsis onClick={(e) => {
            this.getBooksData(this.state.api, this.state.list_books.current_page-2);
          }}/>);
          for (let number = this.state.list_books.current_page - 1; number <= this.state.list_books.current_page + 1; number++) {
            items.push(
              <Pagination.Item key={number} active={number === active} activeLabel={''} onClick={(e) => {
                this.getBooksData(this.state.api, e.target.text);
              }}>
                {number}
              </Pagination.Item>,

            );
          }
          items.push(<Pagination.Ellipsis onClick={(e) => {
            this.getBooksData(this.state.api, this.state.list_books.current_page+2);
          }}/>);
        }
      }
      //----------------------------------------------------------------


      // for (let number = 1; number <= this.state.list_books.last_page; number++) {
      //   items.push(
      //     <Pagination.Item key={number} active={number === active} activeLabel={''} onClick={(e) => {

      //       this.getBooksData(this.state.api, e.target.text);
      //     }}>
      //       {number}
      //     </Pagination.Item>,
      //   );
      // }
    }
    return (
      
      <Container>
      <div>
      {(this.state.list_books !== null)
        ? 
        <p>
        Showing {this.state.list_books.from} - {this.state.list_books.to} of {this.state.list_books.total} books</p> 
        : null
      }
      </div>
        <div className="row">
          {this.state.list_books !== null && this.state.list_books.data.map((item, idx) => (
            <>
            <div className="col-md-3" key={idx}>
              <BookCard index={idx}
                book_price={item.book_price}
                final_price={item.final_price}
                book_title={item.book_title}
                book_cover={item.book_cover_photo}
                author_name={item.author_name}
                id={item.id}
                >
              </BookCard>
            </div>
            </>
          ))}
        </div>

        <Pagination>
          <Pagination.First onClick={() => {

            this.getBooksData(this.state.api, 1);
          }} />
          <Pagination.Prev onClick={() => {

            this.getBooksData(this.state.api, (this.state.list_books.current_page - 1) == 0 ? 1:(this.state.list_books.current_page - 1));
          }} />
          {items}
          <Pagination.Next onClick={() => {

            this.getBooksData(this.state.api, this.state.list_books.current_page == this.state.list_books.last_page ? this.state.list_books.current_page :(this.state.list_books.current_page + 1));
          }} />
          <Pagination.Last onClick={() => {

            this.getBooksData(this.state.api, this.state.list_books.last_page);
          }} />
        </Pagination>
      </Container>

    );

  }
}
export default Books;