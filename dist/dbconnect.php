<?php
const MongoClient = require('mongodb').MongoClient;

const uri = 'mongodb://localhost:27017'; // URI koneksi MongoDB
const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true });

// Menghubungkan ke MongoDB
client.connect((err) => {
  if (err) {
    console.error('Koneksi gagal: ', err);
    return;
  }
  console.log('Terhubung ke MongoDB');

});
?>