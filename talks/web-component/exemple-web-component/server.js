const express = require('express');
const path = require('path');

const app = express();
const PORT = 3000;

// Middleware pour servir les fichiers statiques
app.use(express.static(path.join(__dirname, 'simple')));
app.use(express.static(path.join(__dirname, 'with-props')));

app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'simple', 'index.html'));
});

app.get('/user', (req, res) => {
  res.sendFile(path.join(__dirname, 'with-props', 'index.html'));
});

app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});
