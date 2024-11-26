@extends('layouts.admin.main')
@section('title', 'Test')

@section('content')
    <div class="container py-12 p-5 " style="max-width: 200mm;" id="content">
        <div class="row d-flex align-items-center w-100 ">
            <div class="col-12 text-center">
                <img alt="Logo" src="{{ asset('sense') }}/images/itk.png" class="h-100px" class="h-200px" />
            </div>

        </div>



        <div class="row align-items-center pt-5">
            <p class="btn btn-success text-center fs-2 fw-bold mb-n1 ms-n2" id="btn-itk">Download PDF</p>
        </div>

        <iframe id="frame" style="width: 100%; border: 0; height: 0" src="{{ route('test.pdf') }}"></iframe>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#btn-itk').click(function() {
                html2canvas(
                    document.querySelector('iframe')
                    .contentWindow.document.querySelector('#content'), {
                        scale: 3,
                        useCORS: true,
                        logging: true,
                        letterRendering: true,
                    }
                ).then((canvas) => {
                    let base64image = canvas.toDataURL('image/png');
                    let pdf = new jsPDF('p', 'px', [750, 1169]);

                    let imageWidth = 677;
                    let imageHeight = 1000;
                    let xPosition = (750 - imageWidth) / 2;
                    let yPosition = 40;

                    pdf.addImage(base64image, 'PNG', xPosition, yPosition, imageWidth, imageHeight);
                    pdf.addPage();

                    pdf.addImage(base64image, 'PNG', xPosition, yPosition, imageWidth, imageHeight);

                    var pdfOutput = pdf.output('bloburl');

                    window.open(pdfOutput, '_blank');
                });
            });

            // $('#btn-itk').click(function() {

            //     let f = document.getElementById('frame').contentWindow;
            //     f.focus();
            //     f.print();
            // });

        });
    </script>
@endsection
