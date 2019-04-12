import React, { Component } from 'react';
import registryItems from '../../data/registryItems.json';
import RegistryItem from '../../components/RegistryItem';
import Modal from 'react-modal';
import './index.scss';

export default class RegistryPage extends Component {
  constructor(props) {
    super(props)
    this.state = {
      registry: [],
      modalOpen: false,
      name: null,
      img: null,
      price: null,
      url: null,
    }
  }

  addItem = () => {
    var newRegistry = this.state.registry
    const { name, img, price, url } = this.state
    var newId = newRegistry.length
    var newItem = {
      id: newId,
      name, 
      img,
      price,
      url
    }
    newRegistry.push(newItem)
    this.setState({ registry: newRegistry, modalOpen: false, name: null, img: null, price: null, url: null });
    localStorage.setItem('jnj_registry', JSON.stringify(newRegistry))
  }

  removeItem = removeId => {
    var newRegistry = this.state.registry.filter(({id}) => id !== removeId)
    this.setState({registry: newRegistry})
    localStorage.setItem('jnj_registry', JSON.stringify(newRegistry))
  }

  updateField = (field, value) => {
    var newState = {}
    newState[field] = value
    this.setState(newState)
  }

  componentDidMount() {
    // here is where your fetch would go
    var registry = registryItems
    var localStorageRegistryStr = localStorage.getItem('jnj_registry')
    if(localStorageRegistryStr) {
      registry = JSON.parse(localStorageRegistryStr)
    }
    this.setState({registry})
  }

  render() {
    const { registry, modalOpen } = this.state;
    return (
      <div>
        <div className="header">Registry</div>
        <button className="add-item" onClick={() => this.setState({modalOpen: true})}>Add Item</button>
        <button className="back" onClick={() => this.props.history.goBack()}>Return to Home</button>
        {
          registry.map(({ id, name, img, price, url }) => {
            return <RegistryItem key={id} onRemove={id => this.removeItem(id)} id={id} name={name} img={img} price={price} url={url} />
          })
        }
        <Modal
          isOpen={modalOpen}
          onRequestClose={() => this.setState({modalOpen: false})}
        >
          <div className="header">Add New Registry Item</div>
          <div className="form-item">
            <div>Name</div>
            <input type="text" onChange={e=>this.updateField('name', e.target.value)} />
          </div>
          <div className="form-item">
            <div>Image URL</div>
            <input type="text" onChange={e=>this.updateField('img', e.target.value)} />
          </div>
          <div className="form-item">
            <div>Price</div>
            <input type="text" onChange={e=>this.updateField('price', e.target.value)} />
          </div>
          <div className="form-item">
            <div>Page URL</div>
            <input type="text" onChange={e=>this.updateField('url', e.target.value)} />
          </div>
          <button onClick={this.addItem}>Add</button>
          <button className="close" onClick={() => this.setState({modalOpen: false})}>Cancel</button>
        </Modal>
      </div>
    )
  }
}
