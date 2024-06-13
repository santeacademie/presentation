class UserCard extends HTMLElement {
  static get observedAttributes() {
    return ['name', 'age'];
  }

  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.shadowRoot.innerHTML = `
      <style>
        :host {
          display: block;
          padding: 20px;
          background-color: #f9f9f9;
          border: 1px solid #ccc;
          border-radius: 8px;
          max-width: 200px;
        }
        .user-card {
          text-align: center;
        }
        .user-card h2 {
          margin: 0;
          font-size: 1.5em;
        }
        .user-card p {
          margin: 0;
          color: #555;
        }
      </style>
      <div class="user-card">
        <h2 id="name"></h2>
        <p id="age"></p>
      </div>
    `;
  }

  attributeChangedCallback(name, oldValue, newValue) {
    this.render();
  }

  connectedCallback() {
    this.render();
  }

  render() {
    this.shadowRoot.getElementById('name').textContent = this.getAttribute('name');
    this.shadowRoot.getElementById('age').textContent = `Age: ${this.getAttribute('age')}`;
  }
}

customElements.define('user-card', UserCard);
