const express = require('express');
const app = express();
const port = 8181;

app.get('/', (req, res) => {
  res.send('eVoting Application Running!');
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
