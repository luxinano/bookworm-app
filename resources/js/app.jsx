import React from 'react';
import ReactDOM from 'react-dom';
import HomePage from './homepage';
import Header from './header';
import Footer from './footer';
import ShopPage from './shoppage';
import AboutPage from './about'
import BookDetail from './bookdetail';

import { HashRouter, Routes, Route } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';
ReactDOM.render(

  <HashRouter>

    {<Header />}

    <Routes>
      <Route path="/" element={<HomePage />} exact />
      <Route path="/homepage" element={<HomePage />} />
      <Route path="/books" exact element={<ShopPage />} />
      <Route path="/about" exact element={<AboutPage />} />
       <Route path="/book/:id" element={<BookDetail/> }/>  
    
    </Routes>
    {<Footer />}

  </HashRouter>

  ,
  document.getElementById('root')
);