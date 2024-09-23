  $("#Finishlater").click(function (e) { 
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Finish later!"
          }).then((result) => {
            if (result.isConfirmed) {
          window.location.href="/";
            }
          });
    });
    
    let QuestionOptions = [{
            QuestionNo: 1,
            Question: "How does your skin feel a few hours after washing it?",
            Option: [
                "Tight and dry",
                "Oily, especially in the T-zone area",
                "Oily all over",
                "Flaky in some spots, oily in others",
                "Generally oily and prone to breakouts",
                "Not sure / Don't really know"
            ]
        },
        {
            QuestionNo: 2,
            Question: "How often do you experience breakouts (acne pimples)?",
            Option: [
                "Rarely, my skin is usually clear",
                "Sometimes due to hormones or stress",
                "Frequently, especially in the T-zone",
                "Frequently around chin and jawline",
                "Very often and they can be severe",
                "Not sure / Don't really know"
            ]
        },
        {
            QuestionNo: 3,
            Question: "How does your skin react to sun exposure?",
            Option: [
                "It burns easily and gets red",
                "It tans easily and rarely burns",
                "It becomes oily and shiny",
                "It feels sensitive and irritated",
                "More breakouts after sun exposure",
                "Not sure / Don't really know"
            ]
        },
        {
            QuestionNo: 4,
            Question: "How does your skin feel after using skincare products?",
            Option: [
                "It feels dry or tight",
                "It feels oily after a while",
                "Gets oily fast and may break out",
                "It becomes red or irritated",
                "Breaks out often with new products",
                "Not sure / Don't really know"
            ]
        },
        {
            QuestionNo: 5,
            Question: "Are your pores visible and where are they most noticeable?",
            Option: [
                "My pores are small and barely visible",
                "My pores are visible in the T-zone",
                "Large pores all over the face",
                "Large in some areas, small in others",
                "Large, often clogged pores",
                "Not sure / Don't really know"
            ]
        },
        {
            QuestionNo: 6,
            Question: "How does your skin feel during the winter season?",
            Option: [
                "Very dry and flaky",
                "Lightly oily in T-zone, normal otherwise",
                "Oily and prone to breakouts",
                "Dry in some areas, oily in others",
                "Dry but still prone to breakouts",
                "Not sure / Don't really know"
            ]
        },
        {
            QuestionNo: 7,
            Question: "How often does your skin feel sensitive or irritated?",
            Option: [
                "Rarely",
                "Occasionally",
                "Rarely, except when using new products",
                "Frequently",
                "Frequent, after acne treatments",
                "Not sure / Don't really know"
            ]
        },
        {
            QuestionNo: 8,
            Question: "How does your skin feel in the morning before washing your face?",
            Option: [
                "Dry and tight",
                "Oily, especially in the T-zone",
                "Oily all over",
                "Dry in some areas, oily in others",
                "Oily and often with new breakouts",
                "Not sure / Don't really know"
            ]
        },
        {
            QuestionNo: 9,
            Question: "Do you experience any redness or irritation after using skincare products or makeup?",
            Option: [
                "My skin tolerates most products well",
                "Occasionally, with certain products",
                "Rarely, mostly with heavy products",
                "Yes, often",
                "Yes, especially after acne products",
                "Not sure / Don't really know"
            ]
        },
        {
            QuestionNo: 10,
            Question: "How would you describe your skin's overall texture?",
            Option: [
                "Dry and rough",
                "Oily and shiny",
                "Uneven with both oily and dry patches",
                "Uneven with sensitivity in some areas",
                "Oily with frequent breakouts",
                "Not sure / Don't really know"
            ]
        }
    ];

    function IncreaseProgress(width) {
        let QuestionNo = width;
        width = width * 10;
        $("#ProgressPercentage").html(`${width}%`);
        gsap.to("#ProgressBar", {
            width: width + "%",
            duration: 0.3,
        })
        $("#QuestionNo").html(`${QuestionNo}`);
    }

    function ShowData(index) {
        let Options = '';
        QuestionOptions[index].Option.forEach((key, index) => {
            Options += `<button class="border border-[#00adef] bg-card text-[#ff007f] py-4 px-6 rounded-md hover:bg-[#00adef] hover:text-white duration-300 Option" data-index="${index}">${key}</button>`
        })
        gsap.to("#Question, #Option", {
            duration: 0.3,
            opacity: 0,
            y: 20,
            onComplete: function() {
                $('#Question').html(QuestionOptions[index].Question);
                $("#Option").html(Options);
                IncreaseProgress(index + 1);
                gsap.fromTo("#Question, #Option", {
                    opacity: 0,
                    y: 20,
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.3
                });
            }
        });
    }

    let index = 0;
    ShowData(index);
    let Scores = [0, 0, 0, 0, 0, 0];
    $(document).on("click", ".Option", function() {
        let SelectedDataAttr = $(this).data("index");
        index++;
        if (index < QuestionOptions.length) {
            Scores[SelectedDataAttr]++;
            setTimeout(() => {
                ShowData(index);
            }, 100);
        } else {
            const HighestIndex = GetHighestScoreIndex(Scores);
            ShowRecommendation(HighestIndex);
        }
    });

    function GetHighestScoreIndex(Scores) {
        const MaxScore = Math.max(...Scores);
        const MaxIndexes = [];

        for (let i = 0; i < Scores.length; i++) {
            if (Scores[i] === MaxScore) {
                MaxIndexes.push(i);
            }
        }

        if (MaxIndexes.length > 1) {
            if (MaxIndexes.includes(4)) return 4;
            if (MaxIndexes.includes(1)) return 1;
            if (MaxIndexes.includes(3)) return 3;
            if (MaxIndexes.includes(2)) return 2;
            if (MaxIndexes.includes(0)) return 0;
        } else {
            return MaxIndexes[0];
        }
    }

    function ShowRecommendation(HighestIndex) {
        switch (HighestIndex) {
            case 0:
                ShowTestResult("Dry", "Your skin craves moisture. Nourish it deeply to reveal a soft and radiant glow that lasts all day.");
                break;
            case 1:
                ShowTestResult("Oily", "Shine control and balance are key. Keep the oil in check while letting your natural radiance shine through.");
                break;
            case 2:
                ShowTestResult("Combination", "Balance is beauty. Embrace a routine that caters to both dry and oily areas for a harmonious glow.");
                break;
            case 3:
                ShowTestResult("Sensitive", "Your skin deserves extra care. Soothe and protect it with gentle products that bring out its natural beauty.");
                break;
            case 4:
                ShowTestResult("Acne Prone", "Clear skin is within reach. Fight breakouts with powerful yet gentle solutions that keep your skin fresh and confident.");
                break;
            case 5:
                ShowTestResult("Skin type unclear", "No worries, discovering your skin's needs can take time. Consider consulting a skincare expert for personalized advice and tips.");
                break;
            default:
                alert("Something went wrong. Please try again.");
                break;
        }

    }

    function ShowTestResult(SkinType, Quote) {
        $(".DocBody").removeClass("DocBody");
        $("#Recommendation").removeClass("hidden");
        $("#Recommendation").addClass("md:mb-0 mb-[6rem]");
        $("#body").addClass("mb-[1.5rem]");
        $("#body").html(`<div class="w-[100vw] md:max-w-xl rounded-lg shadow-lg card pt-8">
        <div class="text-center">
            <h1 class="text-xl">
             <span class="text-[#ff007f] text-3xl font-bold">${SkinType=="Skin type unclear"? SkinType : SkinType + " skin"}</span>
            </h1>
        </div>
        <div class="rounded-lg overflow-hidden">
            <div class="p-6 md:p-8 lg:p-10 text-center !pt-2">
                <p class="mt-2 text-md text-primary-foreground/80 italic">${Quote}</p>
        </div>
        </div>
        </div>
        `);

        $.ajax({
            type: "POST",
            url: "Assets/PHP/Configuration/Common Function.php",
            data: {
                TestResult: true,
                SkinType: SkinType,
            },
            success: function(response) {
                $("#Result").html(response);

            }
        });
    }
