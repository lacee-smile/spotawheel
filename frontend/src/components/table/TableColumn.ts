export default class TableColumn {
  constructor(
    private name: string,
    private attributes: Record<string, any> | null
  ) {}

  public get display(): string {
    return this.attributes?.display ?? this.attributes?.data ?? this.name ?? "";
  }

  public get data(): string {
    return this.attributes?.data ?? this.attributes?.display ?? this.name ?? "";
  }

  public get className(): string | null {
    return this.attributes?.class ?? this.attributes?.className ?? null;
  }

  public get style(): string | null {
    return this.attributes?.style ?? null;
  }

  public get render(): CallableFunction | null {
    return this.attributes?.render ?? null;
  }

  public get hasRender(): boolean {
    return !!this.attributes?.render;
  }
}
