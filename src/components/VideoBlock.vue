<template>
  <k-block-figure
    :is-empty="!video.url"
    empty-icon="image"
    empty-text="No file selected yet …"
    @open="open"
    @update="update"
  >
    <VideoPlayer v-if="src" :src="src" :thumb="thumb" />
  </k-block-figure>
</template>

<script>
import VideoPlayer from "./VideoPlayer.vue";

export default {
  name: "VideoBlock",
  components: {
    VideoPlayer,
  },
  data() {
    return {
      mux: null,
    };
  },
  computed: {
    video() {
      return this.content.video[0] || {};
    },
    id() {
      return this.mux?.playback_ids[0].id;
    },
    src() {
      if (!this.id) return "";
      return `https://stream.mux.com/${this.id}.m3u8`;
    },
    thumb() {
      if (!this.id) return "";
      const url = `https://image.mux.com/${this.id}/thumbnail.jpg`;
      const srcset = [300, 600, 900, 1200, 1600];
      return {
        src: url,
        srcset: srcset.map((w) => `${url}?width=${w} ${w}w`).join(", "),
      };
    },
  },
  watch: {
    "video.link": {
      handler(link) {
        if (link) {
          this.$api.get(link).then((file) => {
            this.mux = JSON.parse(file.content.mux);
          });
        }
      },
      immediate: true,
    },
  },
};
</script>
