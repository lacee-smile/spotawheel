export default class Payment {
  constructor(
    public id: number,
    public amount: number,
    public client_id: number,
    public created_at: string,
    public updated_at: string
  ) {
    
  }
}
