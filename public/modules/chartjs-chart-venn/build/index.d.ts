/**
 * chartjs-chart-venn
 * https://github.com/upsetjs/chartjs-chart-venn
 *
 * Copyright (c) 2021 Samuel Gratzl <sam@sgratzl.com>
 */

import { CommonElementOptions, Element, VisualElement, DatasetController, UpdateMode, ControllerDatasetOptions, ScriptableAndArrayOptions, ScriptableContext, CommonHoverOptions, Chart, ChartItem, ChartConfiguration } from 'chart.js';

interface ITextLocation {
    text: {
        x: number;
        y: number;
    };
}
interface ICircle {
    r: number;
    cx: number;
    cy: number;
}
interface IEllipse {
    rx: number;
    ry: number;
    rotation: number;
    cx: number;
    cy: number;
}
interface ITextCircle extends ICircle, ITextLocation {
    align: 'start' | 'end' | 'middle';
    verticalAlign: 'top' | 'bottom';
}
interface ITextEllipse extends IEllipse, ITextLocation {
    align: 'start' | 'end' | 'middle';
    verticalAlign: 'top' | 'bottom';
}
interface IArc {
    x2: number;
    y2: number;
    sweep: boolean;
    large: boolean;
    ref: number;
    mode: 'i' | 'o';
}
interface IArcSlice {
    sets: readonly number[];
    x1: number;
    y1: number;
    arcs: readonly IArc[];
    path?: string;
}
interface ITextArcSlice extends IArcSlice, ITextLocation {
}
interface IBoundingBox {
    x: number;
    y: number;
    width: number;
    height: number;
}

declare type IArcSliceOptions = CommonElementOptions;
interface IArcSliceProps extends ITextArcSlice {
    refs: (ICircle | IEllipse)[];
}
declare class ArcSlice extends Element<IArcSliceProps, IArcSliceOptions> implements VisualElement {
    static readonly id = "arcSlice";
    static readonly defaults: {
        backgroundColor: string;
    };
    static readonly defaultRoutes: {
        borderColor: string;
    };
    inRange(mouseX: number, mouseY: number): boolean;
    inXRange(mouseX: number): boolean;
    inYRange(mouseY: number): boolean;
    getCenterPoint(): {
        x: number;
        y: number;
    };
    tooltipPosition(): {
        x: number;
        y: number;
    };
    hasValue(): boolean;
    draw(ctx: CanvasRenderingContext2D): void;
}
declare module 'chart.js' {
    interface ElementOptionsByType {
        arcSlice: IArcSliceOptions;
    }
}

interface IVennDiagramLayout {
    sets: (ITextCircle | ITextEllipse)[];
    intersections: ITextArcSlice[];
}

declare class VennDiagramController extends DatasetController<'venn', ArcSlice> {
    static readonly id: string;
    static readonly defaults: {
        dataElementType: string;
    };
    static readonly overrides: any;
    initialize(): void;
    update(mode: UpdateMode): void;
    protected computeLayout(size: IBoundingBox): IVennDiagramLayout;
    updateElements(slices: ArcSlice[], start: number, count: number, mode: UpdateMode): void;
    draw(): void;
}
interface IVennDiagramControllerDatasetOptions extends ControllerDatasetOptions, ScriptableAndArrayOptions<IArcSliceOptions, ScriptableContext<'venn'>>, ScriptableAndArrayOptions<CommonHoverOptions, ScriptableContext<'venn'>> {
}
declare module 'chart.js' {
    interface ChartTypeRegistry {
        venn: {
            chartOptions: CoreChartOptions<'venn'>;
            datasetOptions: IVennDiagramControllerDatasetOptions;
            defaultDataPoint: number;
            parsedDataType: {
                x: number;
                y: number;
            };
            scales: keyof CartesianScaleTypeRegistry;
        };
    }
}
declare class VennDiagramChart<DATA extends unknown[] = number[], LABEL = string> extends Chart<'venn', DATA, LABEL> {
    static id: "venn";
    constructor(item: ChartItem, config: Omit<ChartConfiguration<'venn', DATA, LABEL>, 'type'>);
}

declare class EulerDiagramController extends VennDiagramController {
    static readonly id = "euler";
    static readonly defaults: {
        dataElementType: string;
    };
    protected computeLayout(size: IBoundingBox): IVennDiagramLayout;
}
declare type IEulerDiagramControllerDatasetOptions = IVennDiagramControllerDatasetOptions;
declare module 'chart.js' {
    interface ChartTypeRegistry {
        euler: {
            chartOptions: CoreChartOptions<'euler'>;
            datasetOptions: IEulerDiagramControllerDatasetOptions;
            defaultDataPoint: number;
            parsedDataType: {
                x: number;
                y: number;
            };
            scales: keyof CartesianScaleTypeRegistry;
        };
    }
}
declare class EulerDiagramChart<DATA extends unknown[] = number[], LABEL = string> extends Chart<'euler', DATA, LABEL> {
    static id: string;
    constructor(item: ChartItem, config: Omit<ChartConfiguration<'euler', DATA, LABEL>, 'type'>);
}

interface IGenerateOptions {
    label?: string;
}
interface IRawSet<T> {
    label: string;
    values: readonly T[];
}
interface ISet<T> {
    label: string;
    sets: readonly string[];
    value: number;
    values: readonly T[];
    degree: number;
}
declare function extractSets<T>(data: readonly IRawSet<T>[], options?: IGenerateOptions): {
    labels: string[];
    datasets: [{
        label: string;
        data: ISet<T>[];
    }];
};

export { ArcSlice, EulerDiagramChart, EulerDiagramController, IArcSliceOptions, IArcSliceProps, IEulerDiagramControllerDatasetOptions, IGenerateOptions, IRawSet, ISet, IVennDiagramControllerDatasetOptions, VennDiagramChart, VennDiagramController, extractSets };
//# sourceMappingURL=index.d.ts.map
