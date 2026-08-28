# personal-website

Alvin Allan Dan Pusta's portfolio site. Static HTML, styled with Tailwind CSS v4 via the CLI (no CDN, no build framework).

## Project structure

```
personal-website/
├── index.html          # the site
├── src/
│   └── input.css       # Tailwind entry point + theme (colors, fonts)
├── dist/
│   └── output.css      # compiled CSS (generated — don't edit directly)
├── package.json
└── README.md
```

## Setup

Requires [Node.js](https://nodejs.org) (v18+) and npm.

```bash
npm install
```

## Development

Watches `src/input.css` and rebuilds `dist/output.css` on every change:

```bash
npm run dev
```

Then open `index.html` in your browser (or use `npm run serve` to run it on a local server).

## Build for production

Compiles and minifies the final stylesheet:

```bash
npm run build
```

## Deploy

This is a fully static site — `index.html` + `dist/output.css` is all you need.
Push to GitHub and enable **GitHub Pages** (Settings → Pages → Deploy from branch → `main`),
or drag the folder into [Netlify Drop](https://app.netlify.com/drop).

> Note: run `npm run build` before deploying so `dist/output.css` is up to date — it's the
> compiled file the live site actually uses.