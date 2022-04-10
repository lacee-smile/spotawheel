import TableColumn from "@/components/table/TableColumn";

export default class TableDefinition {
  private static DATA_KEY = "data";
  private processedColumns: TableColumn[];

  constructor(columns: any) {
    this.processedColumns = [];
    for (const property in columns) {
      columns[property][TableDefinition.DATA_KEY] =
        columns[property][TableDefinition.DATA_KEY] ?? property;
      this.processedColumns.push(new TableColumn(property, columns[property]));
    }
  }

  public get columns(): TableColumn[] {
    return this.processedColumns;
  }
}
