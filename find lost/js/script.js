const imageUpload = document.getElementById('imageUpload')

Promise.all([
  faceapi.nets.faceRecognitionNet.loadFromUri('/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
  faceapi.nets.ssdMobilenetv1.loadFromUri('/models')
]).then(start)

function start() {
  const container = document.createElement('div')
  container.style.position = 'relative'
  document.body.append(container)

  fetch('idData/data.json').then(function (response){
      return response.json();
  }).then(function (obj){
    let labels= [];
    console.log(obj.data.length)
    for(var i = 0;i<obj.data.length;i++){
        for(var j=1;j<=2;j++){
            labels.push(obj.data[i]+"_"+j);
        }
      // labels.push(obj.data[i]);
    }
  // console.log(labels);
  // const labels = ['Black Widow', 'Captain America', 'Captain Marvel', 'Hawkeye', 'Jim Rhodes', 'Thor', 'Tony Stark']

  async function test(){
    const labeledFaceDescriptors = await Promise.all(
      labels.map(async label => {
        const descriptions = []
        for (let i = 0; i < labels.length; i++) {
          const img = await faceapi.fetchImage(`imageData/${label}.jpg`)
          const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
          descriptions.push(detections.descriptor)
        }
  
        return new faceapi.LabeledFaceDescriptors(label, descriptions)
      })
    )
    console.log(labeledFaceDescriptors) //To be Deleted
    const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)
    console.log(faceMatcher) //To be Deleted
    let image
    let canvas
    // document.body.append('Loaded')
    document.getElementById("notify").innerHTML = "Loaded!!"
    imageUpload.addEventListener('change', async () => {
      if (image) image.remove()
      if (canvas) canvas.remove()
      image = await faceapi.bufferToImage(imageUpload.files[0])
      image.width = "400" ///----->Changing Width
      image.height= "400" ///----->Temporary Height
      console.log(image) ////To be Deleted
      container.append(image)
      canvas = faceapi.createCanvasFromMedia(image)
      container.append(canvas)
      const displaySize = { width: image.width, height: image.height }
      faceapi.matchDimensions(canvas, displaySize)
      const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
      const resizedDetections = faceapi.resizeResults(detections, displaySize)
      const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
      results.forEach((result, i) => {
        const box = resizedDetections[i].detection.box
        let r = result.toString()
        let id_string = r.charAt(0)+r.charAt(1)
        let id = parseInt(id_string)
        document.getElementById("result").value = id
        const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
        drawBox.draw(canvas)
      })
    })

  }
  test()
  })
}







//------Correct Code -------//
// function loadLabeledImages() {
//   const labels = ['Black Widow', 'Captain America', 'Captain Marvel', 'Hawkeye', 'Jim Rhodes', 'Thor', 'Tony Stark']
//   return Promise.all(
//     labels.map(async label => {
//       const descriptions = []
//       for (let i = 1; i <= 2; i++) {
//         const img = await faceapi.fetchImage(`labeled_images/${label}/${i}.jpg`)
//         const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
//         descriptions.push(detections.descriptor)
//       }

//       return new faceapi.LabeledFaceDescriptors(label, descriptions)
//     })
//   )
// }
