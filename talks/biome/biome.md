---
marp: true
title: Biome (outil tout en un pour format et lint)
theme: santeacademie
author: aro@santeacademie.com
paginate: true
---

## Biome

Parce que vous le valez bien

---

## Une brève histoire de tooling

Fork de 🪦 [Rome](https://github.com/rome/tools) (2020 - 2023)
OSS VC backed
Course au tooling / Migration Rust
Vite, Snowpack, Parcel, Esbuild
Webpack (leader)
ZEIT -> Vercel

---

## Features

Formatter | Linter | ~~Bundler, Compiler~~
Tout en un | Un seul binaire
Tri des imports (adieu le [plugin Trivago](https://github.com/trivago/prettier-plugin-sort-imports))
Plus performant (mais c'est pas une compétition)
`biome check --staged` (adieu `lint-staged`)

---

## Setup extension IDE

Dans `.vscode/settings.json`

```json
{
  "editor.codeActionsOnSave": {
    "source.fixAll.biome": "explicit"
  },
  "editor.defaultFormatter": "biomejs.biome"
}
```

---

## Conclusion

- oxc ?
  - moins de traction
  - focus JS/TS (pas de CSS, Astro, Svelte, Vue, GraphQL)
  - v1 récente
  - si c'est bien, on basculera s'il le faut
