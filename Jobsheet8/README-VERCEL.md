# TECHSTORE MINI — Vercel + Supabase

## Deploy
1. Push this project to GitHub.
2. Import the repository into Vercel.
3. Vercel detects `Dockerfile.vercel` and deploys PHP through FrankenPHP.
4. In Vercel Project Settings → Environment Variables, add:
   - `DB_HOST`
   - `DB_PORT`
   - `DB_NAME`
   - `DB_USER`
   - `DB_PASSWORD`
5. Redeploy.

Use the Supabase Session Pooler values supplied by your project. Do not commit `.env` or database passwords to GitHub.

## Local
The application expects the same environment variables locally. If using a `.env` file, do not commit it; PHP itself does not automatically parse `.env` files.

## Database
The application expects:
- `pelanggan`: `id`, `kode`, `nama`, `email`, `no_hp`, `alamat`
- `produk`: `id`, `kode`, `nama`, `kategori`, `harga`, `stok`

See `supabase-schema.sql` for the expected schema.
