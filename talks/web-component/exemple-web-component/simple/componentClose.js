class MyComponentClose extends HTMLElement {
  constructor() {
    super();
    let attachShadow = this.attachShadow({ mode: 'closed' });
    attachShadow.innerHTML = `
      <style>
        :host {
          display: block;
          padding: 20px;
          background-color: #f0f0f0;
          border: 1px solid #ccc;
        }
      </style>
      <div>
        <h1>Hello, World!</h1>
        <p>This is a CLOSED web component.</p>
      </div>
    `;
  }
}

customElements.define('my-component-close', MyComponentClose);
