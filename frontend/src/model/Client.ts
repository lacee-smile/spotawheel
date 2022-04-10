import Payment from "@/model/Payment";

export default class Client {
  constructor(
    public id: number,
    public name: string,
    public surname: string,
    public created_at: string,
    public updated_at: string,
    public latest_payment?: Payment,
  ) {
    
  }
}