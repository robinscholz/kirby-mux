import VideoBlock from "./components/VideoBlock.vue";

window.panel.plugin("robinscholz/kirby-mux", {
  blocks: {
    "mux-video": VideoBlock,
  },
});
