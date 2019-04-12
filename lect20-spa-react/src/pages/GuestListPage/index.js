import React, { Component } from 'react';
import defaultGuests from '../../data/guests.json';
import Toggle from 'react-toggle';
import './index.scss';
import "react-toggle/style.css";

export default class RegistryPage extends Component {
  constructor(props) {
    super(props)
    this.state = {
      registry: [],
      guests: [],
      newGuestVisible: false,
      name: null,
      numGuests: null,
      attending: false,
    }
  }

  addGuest = () => {
    var newGuestList = this.state.guests
    const { name, numGuests, attending } = this.state
    var newId = newGuestList.length
    var newGuest = {
      id: newId,
      name,
      numGuests: parseInt(numGuests),
      attending
    }
    newGuestList.push(newGuest)
    this.setState({guests: newGuestList, newGuestVisible: false, name: null, numGuests: null, attending: false})
    localStorage.setItem('jnj_guests', JSON.stringify(newGuestList))
  }

  cancelAdd = () => {
    this.setState({ name: null, numGuests: null, attending: false, newGuestVisible: false })
  }

  changeAttendance = changeId => {
    var updatedGuests = this.state.guests
    var guestUpdateIndex = updatedGuests.findIndex(({id}) => id === changeId)
    updatedGuests[guestUpdateIndex].attending = !updatedGuests[guestUpdateIndex].attending
    this.setState({guests: updatedGuests})    
    localStorage.setItem('jnj_guests', JSON.stringify(updatedGuests))
  }

  updateField = (field, value) => {
    var newState = {}
    newState[field] = value
    this.setState(newState)
  }

  removeGuest = removeId => {
    var newGuestList = this.state.guests.filter(({id}) => id !== removeId)
    this.setState({guests: newGuestList})
    localStorage.setItem('jnj_guests', JSON.stringify(newGuestList))
  }

  getTotalAttending = () => {
    var totalGuests = 0
    this.state.guests.forEach(({numGuests, attending}) => {
      if (attending) {
        totalGuests += numGuests
      }
    })
    return totalGuests
  }

  componentDidMount() {
    // here is where your fetch would go
    var guests = defaultGuests
    var localStorageGuestsStr = localStorage.getItem('jnj_guests')
    if(localStorageGuestsStr) {
      guests = JSON.parse(localStorageGuestsStr)
    }
    this.setState({guests})
  }

  render() {
    const { guests, newGuestVisible } = this.state;
    return (
      <div>
        <div className="header">Guest List</div>
        <div className='attendance'>Total Attending: {this.getTotalAttending()}</div>
        {!newGuestVisible &&
          <button className="add-item" onClick={() => this.setState({newGuestVisible: true})}>Add Guest</button>
        }
        <button className="back" onClick={() => this.props.history.goBack()}>Return to Home</button>
        <table className="guest-list">
          <thead>
            <th>Name</th>
            <th>Num Guests</th>
            <th>Attending?</th>
            <th>Actions</th>
          </thead>
          <tbody>
            {
              guests.map(({ id, name, attending, numGuests }) => {
                return (
                  <tr key={id}>
                    <td>{name}</td>
                    <td>{numGuests}</td>
                    <td><Toggle checked={attending || false} onChange={() => this.changeAttendance(id)} /></td>
                    <td><button onClick={() => this.removeGuest(id)}>Remove</button></td>
                  </tr>
                )
              })
            }
            {newGuestVisible &&
                <tr>
                  <td><input type="text" onChange={e => this.updateField('name', e.target.value)} /></td>
                  <td><input type="text" onChange={e => this.updateField('numGuests', e.target.value)} /></td>
                  <td><Toggle checked={this.state.attending} onChange={() => this.setState({attending: !this.state.attending})} /></td>
                  <td>
                    <button onClick={this.addGuest}>Add</button>
                    <button onClick={this.cancelAdd}>Cancel</button>
                  </td>
                </tr>
            }
          </tbody>
        </table>
      </div>
    )
  }
}
