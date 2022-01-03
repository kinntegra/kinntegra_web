# Chart.js Venn and Euler Diagram Chart

[![NPM Package][npm-image]][npm-url] [![Github Actions][github-actions-image]][github-actions-url]

Chart.js module for charting venn diagrams with up to five sets. Adding new chart type: `venn` and `euler`.

**Works only with Chart.js >= 3.0.0-beta**

![Sports Venn Diagram](https://user-images.githubusercontent.com/4129778/84571515-f32f9100-ad93-11ea-9354-039411eef43a.png)

![five sets](https://user-images.githubusercontent.com/4129778/86374498-eca28400-bc84-11ea-8494-ea7d9cd11781.png)

## Install

```bash
npm install --save chart.js chartjs-chart-venn
```

## Usage

see [Samples](https://github.com/upsetjs/chartjs-chart-venn/tree/master/samples) on Github

or at this [![Open in CodePen][codepen]](https://codepen.io/sgratzl/pen/ExPyZjG)

## Venn Diagram

### Data Structure

```ts
const config = {
  type: 'venn',
  data: ChartVenn.extractSets(
    [
      { label: 'Soccer', values: ['alex', 'casey', 'drew', 'hunter'] },
      { label: 'Tennis', values: ['casey', 'drew', 'jade'] },
      { label: 'Volleyball', values: ['drew', 'glen', 'jade'] },
    ],
    {
      label: 'Sports',
    }
  ),
  options: {},
};
```

Alternative data structure

```ts
const config = {
  type: 'venn',
  data: {
    labels: [
      'Soccer',
      'Tennis',
      'Volleyball',
      'Soccer ∩ Tennis',
      'Soccer ∩ Volleyball',
      'Tennis ∩ Volleyball',
      'Soccer ∩ Tennis ∩ Volleyball',
    ],
    datasets: [
      {
        label: 'Sports',
        data: [
          { sets: ['Soccer'], value: 2 },
          { sets: ['Tennis'], value: 0 },
          { sets: ['Volleyball'], value: 1 },
          { sets: ['Soccer', 'Tennis'], value: 1 },
          { sets: ['Soccer', 'Volleyball'], value: 0 },
          { sets: ['Tennis', 'Volleyball'], value: 1 },
          { sets: ['Soccer', 'Tennis', 'Volleyball'], value: 1 },
        ],
      },
    ],
  },
  options: {},
};
```

### Styling of elements

`ArcSlice` elements have the basic `backgroundColor`, `borderColor`, and `borderWidth` properties similar to a regular rectangle.

## Euler Diagram

Euler diagrams are relaxed proportional venn diagrams such that the area of the circles and overlap try to fit the overlapping value.
It is a relaxed in a way that is just approximates the proportions using a numerical optimization process.
Moreover, only one and two set overlaps are used for the computation.
The library uses [venn.js](https://github.com/upsetjs/venn.js) in the background.

### Data Structure

```ts
const config = {
  type: 'euler',
  data: ChartVenn.extractSets(
    [
      { label: 'A', values: [1, 2, 3, 4, 11, 12, 13, 14, 15, 16, 17, 18] },
      { label: 'B', values: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 19, 20, 21, 22, 23] },
      { label: 'C', values: [1, 11, 12, 4, 5, 24, 25, 26, 27, 28, 29, 30] },
    ],
    {
      label: 'Sets',
    }
  ),
  options: {},
};
```

### Styling of elements

see Venn Diagram

## ESM and Tree Shaking

The ESM build of the library supports tree shaking thus having no side effects. As a consequence the chart.js library won't be automatically manipulated nor new controllers automatically registered. One has to manually import and register them.

Variant A:

```js
import { Chart } from 'chart.js';
import { VennDiagramController, ArcSlice } from 'chartjs-chart-venn';

Chart.register(VennDiagramController, ArcSlice);
...

new Chart(ctx, {
  type: VennDiagramController.id,
  data: [...],
});
```

Variant B:

```js
import { VennDiagramChart } from 'chartjs-chart-venn';

new VennDiagramChart(ctx, {
  data: [...],
});
```

## Development Environment

```sh
npm i -g yarn
yarn set version 2
cat .yarnrc_patch.yml >> .yarnrc.yml
yarn
yarn pnpify --sdk vscode
```

### Common commands

```sh
yarn compile
yarn test
yarn lint
yarn fix
yarn build
yarn docs
yarn release
yarn release:pre
```

[mit-image]: https://img.shields.io/badge/License-MIT-yellow.svg
[mit-url]: https://opensource.org/licenses/MIT
[npm-image]: https://badge.fury.io/js/chartjs-chart-venn.svg
[npm-url]: https://npmjs.org/package/chartjs-chart-venn
[github-actions-image]: https://github.com/upsetjs/chartjs-chart-venn/workflows/ci/badge.svg
[github-actions-url]: https://github.com/upsetjs/chartjs-chart-venn/actions
[codepen]: https://img.shields.io/badge/CodePen-open-blue?logo=codepen
