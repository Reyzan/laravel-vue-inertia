# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Tech Stack

- **Backend**: Laravel 12.36 (PHP 8.2+)
- **Frontend**: Vue 3 + TypeScript + Inertia.js 2.x
- **Styling**: Tailwind CSS v4 + Flowbite
- **Build**: Vite 7 with Laravel plugin
- **Testing**: Pest PHP
- **Route Helpers**: Ziggy (Laravel routes in JavaScript)

## Development Commands

### Setup
```bash
composer setup
```
Installs dependencies, creates .env, generates key, runs migrations, and builds assets.

### Development Server
```bash
composer dev
```
Runs three concurrent processes: Laravel server (`php artisan serve`), queue worker, and Vite dev server. This is the primary command for local development.

Alternatively, run components separately:
```bash
php artisan serve          # Development server at http://localhost:8000
npm run dev                # Vite dev server for hot module replacement
php artisan queue:listen   # Queue worker
```

### Testing
```bash
composer test              # Runs all Pest tests
php artisan test           # Alternative test command
php artisan test --filter=TestName  # Run specific test
```

Tests use in-memory SQLite database (configured in phpunit.xml).

### Code Quality
```bash
./vendor/bin/pint          # Laravel Pint code formatter (PSR-12)
./vendor/bin/pint --test   # Check formatting without changes
```

### Building for Production
```bash
npm run build              # Build optimized assets with Vite
```

## Architecture Overview

### Inertia.js Request Flow
This app uses Inertia.js, which creates a SPA experience without building a separate API:

1. Laravel routes (routes/web.php) return Inertia responses: `Inertia::render('PageName', $props)`
2. Inertia automatically resolves Vue components from `resources/js/Pages/{PageName}.vue`
3. Props passed from Laravel controllers are available as component props
4. Shared data across all pages defined in `App\Http\Middleware\HandleInertiaRequests::share()`

### Frontend Structure
- **Entry Point**: `resources/js/app.ts` - Inertia.js setup with Vue 3
- **Pages**: `resources/js/Pages/**/*.vue` - Route-specific components (auto-resolved by Inertia)
- **Layouts**: `resources/js/Layouts/*.vue` - Shared layouts (AuthenticatedLayout, GuestLayout)
- **Components**: `resources/js/Components/*.vue` - Reusable components (Navbar, Sidebar, etc.)
- **Alias**: `@Components` resolves to `/resources/js/Components` (configured in vite.config.js)

### Backend Structure
- **Controllers**: `app/Http/Controllers/` - Standard Laravel controllers
- **Models**: `app/Models/` - Eloquent models
- **Middleware**: `app/Http/Middleware/` - Including HandleInertiaRequests for shared Inertia props
- **Routes**: `routes/web.php` - All web routes (Inertia renders)

### Routing with Ziggy
Ziggy makes Laravel routes available in JavaScript/TypeScript:

```typescript
// In Vue components
import { route } from 'ziggy-js';
route('posts.show', { id: 1 })  // Generates: /posts/1
```

The `route()` helper is available globally via the ZiggyVue plugin.

## Key Development Patterns

### Creating New Inertia Pages
1. Add route in `routes/web.php`:
   ```php
   Route::get('/example', fn() => Inertia::render('Example', [
       'data' => $someData
   ]));
   ```
2. Create Vue component at `resources/js/Pages/Example.vue`:
   ```vue
   <script setup lang="ts">
   defineProps<{ data: any }>();
   </script>
   ```

### Using Layouts
Wrap page content with a layout:
```vue
<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout>
        <!-- Your page content -->
    </AuthenticatedLayout>
</template>
```

### Component Imports
Use the @Components alias for cleaner imports:
```typescript
import { Navbar } from '@Components/Navbar.vue';
import { Sidebar } from '@Components/Sidebar.vue';
```

### Sharing Data Globally
Edit `app/Http/Middleware/HandleInertiaRequests.php` to share data with all Inertia pages:
```php
public function share(Request $request): array
{
    return [
        ...parent::share($request),
        'auth' => [
            'user' => $request->user(),
        ],
    ];
}
```

## Database & Migrations

```bash
php artisan migrate                    # Run migrations
php artisan migrate:fresh --seed       # Fresh migration with seeders
php artisan make:migration create_posts_table  # Create migration
php artisan make:model Post -mfc      # Model with migration, factory, controller
```

## Artisan Helpers

```bash
php artisan route:list                 # List all routes
php artisan tinker                     # REPL for testing code
php artisan make:controller ExampleController --invokable  # Single-action controller
php artisan optimize:clear             # Clear all caches
```

## TypeScript Usage

The frontend uses TypeScript (`.ts` and `.vue` files with `lang="ts"`). Type definitions for Vue components should use `defineProps<T>()` syntax for type-safe props.

## Important Notes

- The app uses **Tailwind CSS v4** (different from v3 - check docs for breaking changes)
- **Flowbite** components are available - configured in tailwind.config.js
- Queue jobs run synchronously in tests (QUEUE_CONNECTION=sync in phpunit.xml)
- The root Blade template is `resources/views/app.blade.php` (configured in HandleInertiaRequests)
