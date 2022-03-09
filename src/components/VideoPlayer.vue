<template>
  <div class="video-player">
    <transition name="fade">
      <img
        v-if="!!thumb && state.playback === 'idle'"
        :src="thumb.src"
        :srcset="thumb.srcset"
        sizes="auto"
        class="thumb"
      />
    </transition>
    <transition name="fade">
      <div
        v-if="
          state.playback === 'idle' ||
          state.playback === 'ended' ||
          state.playback === 'paused'
        "
        class="overlay"
        @click="togglePlayback"
      >
        <button class="overlay__inner">
          <svg
            width="10"
            height="13"
            viewBox="0 0 10 13"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path d="M0 0.388916L10 6.50003L0 12.6111V0.388916Z" />
          </svg>
        </button>
      </div>
    </transition>
    <video
      ref="video"
      class="player-video"
      :loop="false"
      :muted="state.muted"
      preload="auto"
      @play="onPlay"
      @pause="onPause"
      @ended="onEnded"
      @click="togglePlayback"
    />
  </div>
</template>

<script>
import Hls from "hls.js/dist/hls.light.js";

export default {
  name: "VideoPlayer",
  props: {
    src: {
      type: String,
      required: true,
    },
    thumb: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      state: {
        loaded: false,
        playback: "idle",
        muted: false,
      },
      hls: null,
    };
  },
  mounted() {
    this.load();
  },
  beforeUnmount() {
    this.destroy();
  },
  methods: {
    load() {
      if (Hls.isSupported()) {
        this.hls = new Hls();
        this.hls.loadSource(this.src);
        this.hls.attachMedia(this.$refs.video);
        this.hls.on(Hls.Events.MEDIA_ATTACHED, this.onLoad);
      } else {
        this.$refs.video.src = this.src;
        this.$refs.video.load();
        this.state.loaded = true;
      }
    },
    destroy() {
      this.hls.detachMedia();
      this.hls.destroy();
    },
    play() {
      const playPromise = this.$refs.video.play();
      if (playPromise !== null) {
        playPromise.catch(() => {
          this.pause();
        });
      }
    },
    pause() {
      this.$refs.video.pause();
    },
    togglePlayback() {
      if (this.state.playback === "playing") {
        this.pause();
      } else {
        this.play();
      }
    },
    onLoad() {
      this.state.loaded = true;
    },
    onPlay() {
      this.state.playback = "playing";
    },
    onPause() {
      this.state.playback = "paused";
    },
    onEnded() {
      this.state.playback = "ended";
    },
  },
};
</script>

<style lang="postcss" scoped>
.video-player {
  position: relative;
  display: flex;
}

.thumb {
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 10;
}

.overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 20;
}

.overlay__inner {
  width: 56px;
  height: 42px;
  padding-left: 3px;
  background: #000;
  border: 0;
  display: flex;
  color: #fff;
  align-items: center;
  justify-content: center;
  transition: width 0.15s ease-out, height 0.15s ease-out;
  cursor: pointer;
}

.overlay__inner svg {
  width: 14px;
  height: auto;
}

.overlay__inner:active {
  width: 53.333px;
  height: 40px;
}

video {
  width: 100%;
  cursor: pointer;
}
</style>
