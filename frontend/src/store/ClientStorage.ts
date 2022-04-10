import Client from "@/model/Client";
import axios from "@/plugins/axios";

export default {
  state: (): Record<string, unknown> => ({
    clients: [] as Client[],
  }),
  mutations: {
    save(state: any, value: Client[]): void {
      state.clients = value;
    },
  },
  actions: {
    loadClients({ commit }: any): Promise<Client[] | void> {
      return axios
        .get<Client[]>(`/clients`)
        .then(({ data }: { data: Client[] }) => {
          commit("save", data);
        });
    },
    filterClients({ commit }: any,
      { startDate, endDate}: {startDate: string, endDate: string})
      : Promise<Client[] | void> {
      return axios
        .get<Client[]>(`/clients`, {
          params: {
            start_date: startDate,
            end_date: endDate,
          }
        })
        .then(({ data }: { data: Client[] }) => {
          commit("save", data);
        });
    },
  },
  getters: {
    clients(state: any): Client[] {
      return state.clients;
    },
  },
};
