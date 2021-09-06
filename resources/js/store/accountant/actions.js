import axios from "axios";

export const getBillItems = ({commit}) => {
  axios.then(response => {
    commit('SET_CART', response.data);
  })
}
