<?php

namespace Database\Seeders;

use App\Models\Engagement;
use Illuminate\Database\Seeder;

class ClientSuccessStoriesSeeder extends Seeder
{
    public function run(): void
    {
        $disclaimer = 'Please note that each LOA has its own assessment, and the results may differ. The final outcome depends on various factors specific to the case.';

        $stories = [
            [
                'label' => '90% Tax Relief',
                'title' => 'Transforming a P2,193,184 Tax Deficiency into a P211,213 Relief',
                'description' => <<<'TEXT'
A dedicated entrepreneur was shocked to discover a tax deficiency of P2,193,184 after relying on an irresponsible previous bookkeeper. The repercussions were severe -- stress escalated to the point of jeopardizing not only the business but the owner's personal health, with thoughts of selling their home and car to settle the debt.

Upturn's team conducted a thorough assessment, identified areas requiring immediate action, and through strategic negotiations and in-depth knowledge of tax laws, worked diligently to resolve the issues. The tax deficiency was reduced by over 90%, bringing the total liability down to a manageable P211,213 -- restoring peace of mind and allowing the owner to focus on business and personal goals.

Result: P2,193,184 -> P211,213 (over 90% reduction)
TEXT,
            ],
            [
                'label' => 'Case Dismissed',
                'title' => 'From P54 Million Tax Deficiency to Zero',
                'description' => <<<'TEXT'
A taxpayer faced an alarming P54 million alleged tax deficiency following a BIR audit. The looming threat of legal repercussions and financial ruin cast a shadow over the business. Upturn initiated a comprehensive review, identifying discrepancies and formulating a strategic response to challenge the BIR's findings.

Through meticulous negotiations and detailed discussions with BIR officials, Upturn's commitment to thorough research and robust defense strategies proved decisive. The BIR ultimately abandoned the case -- no Preliminary Assessment Notice (PAN) was issued, and no Final Assessment Notice was ever issued. The taxpayer emerged without having paid a single peso of the alleged P54 million liability.

Result: P54,000,000 -> P0 (case fully dismissed)
TEXT,
            ],
            [
                'label' => '75%+ Reduction',
                'title' => 'How a Doctor Cleared 80+ BIR Cases and Reduced Penalties by 75%',
                'description' => <<<'TEXT'
A professional doctor had been registered with the BIR since 2012 but moved abroad before filing any returns. Over a decade later, a chance conversation with an Upturn tax professional uncovered over 80 open BIR cases stemming from years of unfiled returns. Critical documents -- Certificate of Registration (COR), Authority to Print (ATP), and Books of Accounts -- were also missing, with potential penalties totaling around P200,000 and the risk of criminal charges.

Upturn took over the case, working through all 80+ cases, reducing penalties by over 75%, bringing the total down to under P50,000, and securing a Certificate of No Outstanding Liability from the BIR -- confirming full compliance and restoring the doctor's peace of mind.

Result: 80+ open cases cleared, penalties reduced by 75%+, Certificate of No Outstanding Liability secured
TEXT,
            ],
            [
                'label' => '98.7% Reduction',
                'title' => 'From P7,941,512.23 to P100,955.09',
                'description' => <<<'TEXT'
A client received a Notice of Discrepancy after a BIR audit with an initial assessment of P7,941,512.23 -- a figure that caused significant stress and uncertainty. The issue stemmed from transactions that were kept off the record, leading the BIR to make its own estimates that leaned heavily against the taxpayer.

Upturn worked meticulously with the client to reconcile their books, prepare position papers and justifications, and attend discussions with revenue officers. Through persistence, due diligence, and a commitment to proper compliance, the assessment was successfully reduced from P7.9 million to P100,955.09 -- a fair and accurate reflection of the client's true tax obligations.

Result: P7,941,512.23 -> P100,955.09 (98.7% reduction)
TEXT,
            ],
            [
                'label' => 'Zero Balance',
                'title' => 'From P26,521,926.08 Liability to Zero Balance',
                'description' => <<<'TEXT'
A BPO client had all their transactions assessed as VAT, resulting in a P27 million penalty that placed a heavy financial burden on operations. Upturn carefully reviewed the case, gathered proper documentation, and applied the appropriate legal remedies -- including the Three-Year Prescriptive Period under Section 203 of the NIRC, which states that the BIR must issue and serve the Final Assessment Notice within three years from the filing deadline or actual filing date.

By applying this rule and ensuring full compliance with all requirements, Upturn presented the client's case effectively. The outcome was a complete resolution -- the P27 million liability was reduced to zero.

Result: P26,521,926.08 -> P0 (full resolution via prescriptive period)
TEXT,
            ],
        ];

        foreach ($stories as $index => $story) {
            Engagement::updateOrCreate(
                [
                    'section' => Engagement::SECTION_CLIENT_SUCCESS_STORIES,
                    'label' => $story['label'],
                ],
                [
                    'title' => $story['title'],
                    'label' => $story['label'],
                    'description' => trim($story['description'])."\n\nDisclaimer: {$disclaimer}",
                    'images' => [],
                    'sort_order' => $index + 1,
                    'is_published' => true,
                ]
            );
        }
    }
}
