<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service;

use App\Constants\State\AttachmentState;
use App\Core\Dao\AttachmentDao;

class AttachmentService extends AbstractService
{
    protected $dao = AttachmentDao::class;

    /**
     * 保存上传文件信息
     * @param array $fileData
     * @param string $hash
     * @param string $key
     * @param string $system
     * @return int
     */
    public function createUpload(array $fileData, string $hash, string $key, string $system = AttachmentState::SYSTEM_QINIU)
    {
        $config = config('custom')['attachment'];
        $md5 = '';
        if ($fileData['size'] <= $config['check_md5'] && file_exists($fileData['tmp_file'])) {
            $md5 = md5_file($fileData['tmp_file']);
        }

        $data = [
            'system' => $system,
            'type' => $fileData['type'],
            'size' => $fileData['size'],
            'hash' => $hash,
            'key' => $key,
            'index' => $this->generateIndex($key),
            'md5' => $md5,
            'status' => AttachmentState::STATUS_ENABLED
        ];
        return $this->create($data);
    }

    /**
     * 文件失效
     * @param string $key
     */
    public function failure(string $key)
    {
        $dao = new AttachmentDao();
        $info = $dao->getInfoByIndex($this->generateIndex($key));
        $info->status = AttachmentState::STATUS_DISABLED;
        $info->save();
    }

    /**
     * 文件批量失效
     * @param array $oldKeys
     * @param array $newKeys
     */
    public function batchFailure(array $oldKeys, array $newKeys)
    {
        $diff = array_diff($oldKeys, $newKeys);
        if (! empty($diff)) {
            $diffIndex = [];
            foreach ($diff as $item) {
                $diffIndex[] = $this->generateIndex($item);
            }
            $dao = new AttachmentDao();
            $dao->updateByCondition([
                ['index', 'in', $diffIndex]
            ], [
                'status' => AttachmentState::STATUS_DISABLED
            ]);
        }
    }

    /**
     * 生成文件查询索引
     * @param string $key
     * @return string
     */
    public function generateIndex(string $key): string
    {
        return md5($key);
    }
}
