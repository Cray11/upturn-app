#!/bin/bash
# Deploy script for upturn-app to Vercel with Supabase

echo "=== Upturn App Deployment ==="
echo ""

# Check if Vercel CLI is installed
if ! command -v vercel &> /dev/null; then
    echo "Vercel CLI not found. Installing..."
    npm install -g vercel
fi

# Check if Supabase CLI is installed
if ! command -v supabase &> /dev/null; then
    echo "Supabase CLI not found. Installing..."
    npm install -g supabase
fi

echo ""
echo "Step 1: Setting up environment variables..."
echo "Please set these in Vercel dashboard (Settings > Environment Variables):"
echo ""
echo "APP_NAME=Upturn Business Solutions"
echo "APP_ENV=production"
echo "APP_KEY=<your-app-key>"
echo "APP_DEBUG=false"
echo "APP_URL=<your-vercel-url>"
echo "DB_CONNECTION=pgsql"
echo "DB_HOST=<your-supabase-host>"
echo "DB_PORT=5432"
echo "DB_DATABASE=postgres"
echo "DB_USERNAME=postgres"
echo "DB_PASSWORD=<your-supabase-password>"
echo "SESSION_DRIVER=database"
echo "CACHE_STORE=database"
echo "QUEUE_CONNECTION=database"
echo ""

echo "Step 2: Deploying to Vercel..."
vercel --prod

echo ""
echo "Step 3: Running migrations (after first deploy)..."
echo "Run this command to migrate your database:"
echo "vercel env pull .env.local"
echo "php artisan migrate --force"
echo ""
echo "=== Deployment Complete ==="
