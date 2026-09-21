-- TECHSTORE MINI - Supabase PostgreSQL
-- Run this only if your existing tables do not already have this structure.

CREATE TABLE IF NOT EXISTS pelanggan (
    id SERIAL PRIMARY KEY,
    kode VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS produk (
    id SERIAL PRIMARY KEY,
    kode VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    harga NUMERIC(15,2) NOT NULL DEFAULT 0,
    stok INTEGER NOT NULL DEFAULT 0
);
