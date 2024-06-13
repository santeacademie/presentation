class MyComponent extends HTMLElement {
  constructor() {
    super();
    const shadow = this.attachShadow({ mode: 'closed' });
    shadow.innerHTML = `
      <style>
        :host {
          display: block;
          padding: 20px;
          background-color: #f0f0f0;
          border: 1px solid #ccc;
        }
      </style>
      <div id="toto">
        <h1>Hello, World!</h1>
        <p>This is a simple web component.</p>
      </div>
    `;
    // let toto = document.createElement("span");
    // document.getElementById('toto').appendChild(toto)
    let a = document.createElement('div');
    a.innerHTML = ('<div style="background:red; width:100px; height: 100px;"></div>');
    let b = document.createElement('div');
    b.innerHTML = ('<div style="background:red; width:100px; height: 100px;"></div>');
    document.body.appendChild(a);
    shadow.appendChild(b)
    //shadow.getElementById('toto').appendChild(toto)
  }
}

customElements.define('my-component', MyComponent);
