<!-- resources/js/components/DicomViewer.vue -->
<template>
  <div id="dwv">
    <div id="dwv-canvas"></div>
    <div id="dwv-tools"></div>
  </div>
</template>

<script>
import dwv from 'dwv';

export default {
  name: 'DicomViewer',
  mounted() {
    // Initialize DWV
    const app = new dwv.App();
    // Append the view
    app.init({
      containerDivId: 'dwv-canvas',
      toolsDivId: 'dwv-tools',
      fitToWindow: true,
    });

    // Load a test DICOM file (replace with your own URL or file path)
    app.loadURLs([this.$props.fileUrl]);
  },
  props: {
    fileUrl: {
      type: String,
      required: true,
    },
  },
};
</script>

<style>
#dwv-canvas {
  width: 100%;
  height: 512px;
}
</style>
