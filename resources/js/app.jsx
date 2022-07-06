import React from 'react';
import ReactDOM from 'react-dom';
import HomePage from './homepage';
import Header from './header';
import Footer from './footer';
import Books from './books';

import { HashRouter, Routes, Route } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';
ReactDOM.render(

  <HashRouter>

    {<Header />}

    <Routes>
      <Route path="/" element={<HomePage />} />
      <Route path="/homepage" element={<HomePage />} />
      <Route path="/books" element={<Books />} />
      
    </Routes>
    {<Footer />}

  </HashRouter>

  ,
  document.getElementById('root')
);