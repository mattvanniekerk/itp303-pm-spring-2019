import React, { Component } from 'react';
import { Switch, Router, Route } from 'react-router-dom';
import { createBrowserHistory } from 'history';
import { Link } from 'react-router-dom';
import RegistryPage from './pages/RegistryPage';
import GuestListPage from './pages/GuestListPage';
import './App.scss';

const history = createBrowserHistory();

class App extends Component {
  render() {
    return (
      <div className="App">
        <div className="wedding-bg" />
        <div className="contents">
          <Router history={history}>
              <Switch>
                <Route exact path="/" render={() => (
                  <div className="home">
                    <h3>Welcome to the Wedding Page of:</h3>
                    <h1 className='header'>Jack and Jill</h1>
                    <Link to="/registry">
                      <button>Visit Registry</button>
                    </Link>
                    <Link to="/guest-list">
                      <button>Visit Guest List</button>
                    </Link>
                  </div>
                )} />
                <Route exact path="/registry" component={RegistryPage} />
                <Route exact path="/guest-list" component={GuestListPage} />
              </Switch>
          </Router>
        </div>
      </div>
    );
  }
}

export default App;
