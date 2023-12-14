import axios from "axios";
import { useSSRContext, mergeProps, resolveComponent, createApp } from "vue";
import { ssrRenderAttrs, ssrRenderComponent } from "vue/server-renderer";
import { initFlowbite } from "flowbite";
import { createRouter, createWebHistory } from "vue-router";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
const app = "";
const _export_sfc = (sfc, props) => {
  const target = sfc.__vccOpts || sfc;
  for (const [key, val] of props) {
    target[key] = val;
  }
  return target;
};
const _sfc_main$2 = {
  name: "Sidebar"
};
function _sfc_ssrRender$2(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  _push(`<aside${ssrRenderAttrs(mergeProps({ class: "sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-gray-900" }, _attrs))}></aside>`);
}
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/Sidebar.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const Sidebar = /* @__PURE__ */ _export_sfc(_sfc_main$2, [["ssrRender", _sfc_ssrRender$2]]);
const _sfc_main$1 = {
  name: "App.vue",
  components: { Sidebar },
  mounted() {
    initFlowbite();
    let flowbite = document.createElement("script");
    flowbite.setAttribute("src", "https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js");
    document.head.appendChild(flowbite);
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_router_view = resolveComponent("router-view");
  _push(`<div${ssrRenderAttrs(mergeProps({
    class: "container relative flex space-x-4",
    style: { "min-height": "100vh" }
  }, _attrs))}>`);
  _push(ssrRenderComponent(_component_router_view, {
    class: "w-78",
    style: { "min-height": "100vh" }
  }, null, _parent));
  _push(`</div>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/App.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const App = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {
  name: "Main"
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "container relative flex space-x-4" }, _attrs))}><aside class="sticky top-0 col-span-3 h-screen w-3/12 justify-center bg-pink-200">Fixed Sidebar</aside><main class="h-full w-9/12 space-y-56 bg-indigo-400 p-4"> Content <p>more content</p><p>more content</p><p>more content</p><p>more content</p><p>more content</p><p>more content</p><p>more content</p><p>more content</p><p>more content</p><p>more content</p></main></div>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/Main.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Main = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
const router = createRouter({
  history: createWebHistory(import.meta.BASE_URL),
  routes: [
    {
      path: "/",
      component: Main
    }
  ]
});
createApp(App).use(router).mount("#app");
