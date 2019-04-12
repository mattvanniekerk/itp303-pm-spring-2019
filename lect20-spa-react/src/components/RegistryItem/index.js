import React, { Component } from 'react';
import './index.scss';

export default class RegistryItem extends Component {
  constructor(props) {
    super(props)
    this.state = {
      purchased: false,
    }
  }

  render() {
    const { id, name, img, price, url, onRemove } = this.props;
    return (
      <div className={`item ${this.state.purchased ? "purchased" : null}`}>
        <a href={url} target="_blank" rel="noopener noreferrer">
          <div className="item-name">{name}</div>
        </a>
        <img alt={name} src={img} width="150" height="150" />
        <div>{price}</div>
        <button onClick={() => this.setState({purchased: !this.state.purchased})}>{this.state.purchased ? 'Cancel' : 'Select'}</button>
        <button onClick={() => onRemove(id)}>Remove</button>
      </div>
    )
  }
}
