import { menuDashboard } from "../modules/menu.js";
import { calculadora } from "../modules/calculadora.js";
import { search } from "../modules/search.js";
import { calcularResumoFinanceiro } from "../utils/calcularResumoFinanceiro.js";
import { calendario } from "../modules/calendario.js";
import { updateDespesas } from "../modules/updateDespesas.js";
import { deleteDespesas } from "../modules/deleteDespesas.js";
import { statusDespesas } from "../modules/statusDespesas.js";
import { currencyMask } from "../masks/currencyMask.js";

menuDashboard();
calculadora();
search();
currencyMask();
deleteDespesas();
updateDespesas();
statusDespesas();
calendario();
