<?php

/**
 * This file is part of the eZ Publish Kernel package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */
namespace eZ\Publish\Core\Search\Common\Slot;

use eZ\Publish\Core\SignalSlot\Signal;
use eZ\Publish\Core\Search\Common\Slot;
use eZ\Publish\SPI\Search\Indexer\ContentIndexer;
use eZ\Publish\SPI\Search\Indexer\LocationIndexer;

/**
 * A Search Engine slot handling CopySubtreeSignal.
 */
class CopySubtree extends Slot
{
    /**
     * Receive the given $signal and react on it.
     *
     * @param \eZ\Publish\Core\SignalSlot\Signal $signal
     */
    public function receive(Signal $signal)
    {
        if (!$signal instanceof Signal\LocationService\CopySubtreeSignal) {
            return;
        }

        if (!$this->searchHandler instanceof ContentIndexer && !$this->searchHandler instanceof LocationIndexer) {
            return;
        }

        $contentHandler = $this->persistenceHandler->contentHandler();

        foreach ($this->persistenceHandler->locationHandler()->loadSubtreeIds($signal->targetNewSubtreeId) as $contentId) {
            $contentInfo = $contentHandler->loadContentInfo($contentId);

            if ($this->searchHandler instanceof ContentIndexer) {
                $this->searchHandler->indexContent(
                    $contentHandler->load($contentInfo->id, $contentInfo->currentVersionNo)
                );
            }

            if ($this->searchHandler instanceof LocationIndexer) {
                $locations = $this->persistenceHandler->locationHandler()->loadLocationsByContent($contentInfo->id);
                foreach ($locations as $location) {
                    $this->searchHandler->indexLocation($location);
                }
            }
        }
    }
}
